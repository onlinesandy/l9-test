<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpdeskTickets;
use App\Models\HelpdeskClient;
use App\Models\HelpdeskProject;
use App\Models\HelpdeskPriority;
use App\Models\HelpdeskStatus;
use App\Models\HelpdeskTicket;
use App\Models\HelpdeskAssign;
use App\Models\HelpdeskAttachment;
use App\Models\HelpdeskComment;
use App\Models\HelpdeskActivity;
use App\Models\HelpdeskCategory;
use App\Models\User;
use DB;
use File;
use Str;
use Notification;
use Carbon;

class HelpdeskController extends Controller
{
    public function index(Request $request)
    {
        $tickets = HelpdeskTicket::get();
        // dd($tickets);

        $viewUrl = 'helpdesk.index';
        return view($viewUrl, [
            'title' => 'Tickets',
            'breadcrumb' => 'Ticket List',
            'help_url' => '/help',
            'tickets' => $tickets,
        ]);
    }

    public function addticket(Request $request)
    {
        return view('helpdesk.add-ticket', [
            'title' => 'Tickets',
            'breadcrumb' => 'Add Ticket',
            'help_url' => '/help',
        ]);
    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required',
        ]);
        $ticket_id = $request->input('ticket_id');
        $updateData = [];
        $type = '';
        $msg = '';

        $t_info = HelpdeskTicket::where('id', $ticket_id)->first();
        if (!empty($request->input('title'))) {
            $updateData['title'] = $request->input('title');
            $type = 'title';
            $from = '<strong>' . $t_info->title . '</strong>';
            $to = '<strong>' . $updateData['title'] . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }
        if (!empty($request->input('description'))) {
            $updateData['description'] = $request->input('description');
            $type = 'description';
            $from = '<strong>' . $t_info->description . '</strong>';
            $to = '<strong>' . $updateData['description'] . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }

        if (!empty($request->input('html'))) {
            $updateData['html'] = $request->input('html');
            $type = 'html';
            $from = '<strong>' . $t_info->html . '</strong>';
            $to = '<strong>' . $updateData['html'] . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
            $msg = '';
        }

        if (!empty($request->input('priority_id'))) {
            $updateData['priority_id'] = $request->input('priority_id');
            $type = 'priority';
            $to_val = $this->getPriorityName($updateData['priority_id']);
            $from = '<strong>' . $t_info->priority->name . '</strong>';
            $to = '<strong>' . $to_val . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }

        if (!empty($request->input('category_id'))) {
            $updateData['category_id'] = $request->input('category_id');
            $type = 'category';
            $to_val = $this->getCategoryName($updateData['category_id']);
            $from = '<strong>' . $t_info->category->name . '</strong>';
            $to = '<strong>' . $to_val . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }
        if (!empty($request->input('project_id'))) {
            $updateData['project_id'] = $request->input('project_id');
            $type = 'project';
            $to_val = $this->getProjectName($updateData['project_id']);
            $from = '<strong>' . $t_info->project->name . '</strong>';
            $to = '<strong>' . $to_val . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }
        if (!empty($request->input('client_id'))) {
            $updateData['client_id'] = $request->input('client_id');
            $type = 'client';
            $to_val = $this->getClientName($updateData['client_id']);
            $from = '<strong>' . $t_info->client->name . '</strong>';
            $to = '<strong>' . $to_val . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }
        if (!empty($request->input('helpdesk_status_id'))) {
            $updateData['ticket_status_id'] = $request->input('helpdesk_status_id');
            $type = 'status';
            $to_val = $this->getStatusName($updateData['ticket_status_id']);
            $from = '<strong>' . $t_info->ticket_status->name . '</strong>';
            $to = '<strong>' . $to_val . '</strong>';
            $msg = $type . ' Changed from `' . $from . '` to `' . $to . '`';
        }

        $ff = HelpdeskTicket::where('id', $ticket_id)->update($updateData);
        $this->activity($ticket_id, $type, $msg);
    }

    public function updateAssignee(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required',
        ]);
        $ticket_id = $request->input('ticket_id');
        $helpdeskAssigneeList = $request->input('helpdeskAssigneeList');

        $assignedArr = HelpdeskAssign::where('ticket_id', $ticket_id)
            ->pluck('user_id')
            ->toArray();

        $helpdeskAssigneeArr = array_map('intval', $helpdeskAssigneeList);

        $exists = array_intersect($assignedArr, $helpdeskAssigneeArr);
        $insertArr = array_diff($helpdeskAssigneeArr, $assignedArr);
        $delArr = array_diff($assignedArr, $helpdeskAssigneeArr);


        $created_by = auth()->user()->id;
        $html = '';

        if (!empty($request->input('helpdeskAssigneeList')) && is_array($request->input('helpdeskAssigneeList')) && count($request->input('helpdeskAssigneeList'))) {
            if (count($insertArr)) {
                $html .= '<p class="text-muted mb-2">
                <i class="ri-user-add-line align-middle ms-2"></i>
                    Ticket Assigned To : ';
                // dd($helpdeskAssigneeList);
                foreach ($insertArr as $assignee) {
                    HelpdeskAssign::create([
                        'ticket_id' => $ticket_id,
                        'user_id' => $assignee,
                        'status' => 1,
                        'created_by' => $created_by,
                    ]);
                    $html .= '<span class="badge bg-soft-success text-success align-middle me-1">' . $this->getUserName($assignee) . '</span>';
                }
                $html .= '</p>';
            }
            if (count($delArr)) {
                HelpdeskAssign::where('ticket_id', $ticket_id)
                    ->whereIn('user_id', $delArr)
                    ->delete();
                $html .= '<p class="text-muted mb-2">
                <i class="ri-user-unfollow-line align-middle ms-2"></i>
                    User Removed : ';
                // dd($helpdeskAssigneeList);
                foreach ($delArr as $assignee) {
                    $html .= '<span class="badge bg-soft-danger text-danger align-middle me-1">' . $this->getUserName($assignee) . '</span>';
                }
                $html .= '</p>';
            }
        }



        $this->activity($ticket_id, 'assignee', $html);
        return redirect()
            ->back()
            ->with('success', 'Assignee List Updated successfully');
    }

    public function addHelpdeskTicket(Request $request)
    {
        $validated = $request->validate([
            'helpdesk_title' => 'required|max:255',
            'helpdesk_description' => 'required',
            'helpdesk_status' => 'required',
            'helpdesk_priority' => 'required',
            'helpdesk_client' => 'required',
            'helpdesk_project' => 'required',
        ]);
        $created_by = auth()->user()->id;
        $ticketMaxID = HelpdeskTicket::max('id');
        if ($ticketMaxID == '') {
            $ticketMaxID = 1;
        } else {
            $ticketMaxID = $ticketMaxID + 1;
        }
        $ticketPrefix = 'KYN';
        $ticket_no = $ticketPrefix . str_pad($ticketMaxID, 6, '0', STR_PAD_LEFT);

        $helpdesk_ticket = HelpdeskTicket::create([
            'title' => $request->input('helpdesk_title'),
            'ticket_no' => $ticket_no,
            'due_date' => $request->input('helpdesk_due_date'),
            'ticket_status_id' => $request->input('helpdesk_status'),
            'priority_id' => $request->input('helpdesk_priority'),
            'description' => $request->input('helpdesk_description'),
            'html' => $request->input('helpdesk_html_content'),
            'client_id' => $request->input('helpdesk_client'),
            'project_id' => $request->input('helpdesk_project'),
            'category_id' => $request->input('helpdesk_category'),
            'created_by' => $created_by,
            'status' => 1,
        ]);

        if (!empty($request->input('helpdeskAssigneeList')) && is_array($request->input('helpdeskAssigneeList')) && count($request->input('helpdeskAssigneeList'))) {
            $helpdeskAssigneeList = $request->input('helpdeskAssigneeList');
            foreach ($helpdeskAssigneeList as $assignee) {
                HelpdeskAssign::create([
                    'ticket_id' => $helpdesk_ticket->id,
                    'user_id' => $assignee,
                    'status' => 1,
                    'created_by' => $created_by,
                ]);
            }
        }

        if (!empty($request->hasFile('helpdesk_images'))) {
            $helpdesk_images = $request->file('helpdesk_images');
            $destPre = resource_path();
            $destPost = '/assets/helpdesk/' . $ticket_no . '/';
            $destinationPath = $destPre . $destPost;

            foreach ($helpdesk_images as $attachment) {
                $originalFile = $attachment->getClientOriginalName();
                $filename = Carbon::now()->timestamp . '-' . $originalFile;
                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }

                $attachment->move($destinationPath, $filename);
                HelpdeskAttachment::create([
                    'ticket_id' => $helpdesk_ticket->id,
                    'user_id' => auth()->user()->id,
                    'file' => $destPost . $filename,
                    'status' => 1,
                ]);
            }
        }
        $this->activity($helpdesk_ticket->id, 'new');
        return redirect()
            ->back()
            ->with('success', 'Ticket created successfully');
    }

    public function viewticket(Request $request)
    {
        $ticketno = $request->ticketno;

        $ticket = HelpdeskTicket::where('ticket_no', $ticketno)->first();
        $ticket_attachments = HelpdeskAttachment::where('ticket_id', $ticket->id)->get();
        $ticket_assignee_list = HelpdeskAssign::where('ticket_id', $ticket->id)->get();
        $ticket_comments = HelpdeskComment::where('ticket_id', $ticket->id)->get();
        $ticket_activities = HelpdeskActivity::where('ticket_id', $ticket->id)
            ->orderBy('id', 'desc')
            ->get();
        $ticket_status_list = HelpdeskStatus::where('status', 1)->get();
        $ticket_client_list = HelpdeskClient::where('status', 1)->get();
        $ticket_project_list = HelpdeskProject::where('status', 1)->get();
        $ticket_priority_list = HelpdeskPriority::where('status', 1)->get();
        $ticket_category_list = HelpdeskCategory::where('status', 1)->get();

        return view('helpdesk.view-ticket', [
            'ticket' => $ticket,
            'ticket_attachments' => $ticket_attachments,
            'ticket_assignee_list' => $ticket_assignee_list,
            'ticket_comments' => $ticket_comments,
            'ticket_activities' => $ticket_activities,
            'ticket_status_list' => $ticket_status_list,
            'ticket_priority_list' => $ticket_priority_list,
            'ticket_client_list' => $ticket_client_list,
            'ticket_project_list' => $ticket_project_list,
            'ticket_category_list' => $ticket_category_list,
        ]);
    }

    public function helpdeskUploadImg(Request $request)
    {
        $validated = $request->validate([
            'helpdeskViewImgTicketId' => 'required',
        ]);
        $ticket_id = $request->input('helpdeskViewImgTicketId');
        if (!empty($request->hasFile('helpdesk_view_images'))) {
            $html = '<p class="text-muted mb-2">Added attachments</p>
            <div class="row"><div class="col-xxl-4"><div class="row border border-dashed gx-2 p-2 mb-2">';

            $t = HelpdeskTicket::where('id', $ticket_id)->first();
            $helpdesk_images = $request->file('helpdesk_view_images');
            $destPre = resource_path();
            $destPost = '/assets/helpdesk/' . $t->ticket_no . '/';
            $destinationPath = $destPre . $destPost;

            foreach ($helpdesk_images as $attachment) {
                $originalFile = $attachment->getClientOriginalName();
                $filename = Carbon::now()->timestamp . '-' . $originalFile;
                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }

                $attachment->move($destinationPath, $filename);
                $d_path = 'http://127.0.0.1:5173/resources' . $destPost . $filename;
                $html .= '<div class="col-4"><img src="' . $d_path . '" alt="" class="img-fluid rounded"></div>';

                HelpdeskAttachment::create([
                    'ticket_id' => $ticket_id,
                    'user_id' => auth()->user()->id,
                    'file' => $destPost . $filename,
                    'status' => 1,
                ]);
            }
            $html .= '</div></div></div>';
            $this->activity($ticket_id, 'attachment', $html);
            return redirect()
                ->back()
                ->with('success', 'Image Uploaded successfully');
        }
        return redirect()->back();
    }

    public function downloadFile($id)
    {
        $file = HelpdeskAttachment::where('id', $id)
            ->pluck('file')
            ->first();
        return response()->download(resource_path() . $file);
    }

    public function deleteAttachment($id)
    {
        $f = HelpdeskAttachment::where('id', $id)->first();
        $this->activity($f->ticket_id, 'del_attachment');
        HelpdeskAttachment::where('id', $id)->delete();
        if (file_exists(resource_path() . $f->file)) {
            @unlink(resource_path() . $f->file);
        }
        return redirect()
            ->back()
            ->with('success', 'File deleted successfully');
    }

    public function getHelpdeskAssigneeList(Request $request)
    {
        $search = $request->search; // Ajax Search

        $response = [];
        $clients = User::all();
        foreach ($clients as $row) {
            $response[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }
        return response()->json($response);
    }

    public function getHelpdeskClients(Request $request)
    {
        $search = $request->search; // Ajax Search

        $response = [];
        $response[] = [
            'id' => 'add_new',
            'text' => 'Add New',
            'modal' => 'helpdesk_add_client_model',
        ];

        $clients = HelpdeskClient::all();
        foreach ($clients as $row) {
            $response[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }
        return response()->json($response);
    }

    public function getHelpdeskProjects(Request $request)
    {
        $search = $request->search; // Ajax Search

        $response = [];
        $response[] = [
            'id' => 'add_new',
            'text' => 'Add New',
            'modal' => 'helpdesk_add_project_model',
        ];

        $clients = HelpdeskProject::all();
        foreach ($clients as $row) {
            $response[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }
        return response()->json($response);
    }

    public function getHelpdeskPriority(Request $request)
    {
        $search = $request->search; // Ajax Search

        $response = [];
        $response[] = [
            'id' => 'add_new',
            'text' => 'Add New',
            'modal' => 'helpdesk_add_priority_model',
        ];

        $clients = HelpdeskPriority::all();
        foreach ($clients as $row) {
            $response[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }
        return response()->json($response);
    }

    public function getHelpdeskCategory(Request $request)
    {
        $search = $request->search; // Ajax Search

        $response = [];
        $response[] = [
            'id' => 'add_new',
            'text' => 'Add New',
            'modal' => 'helpdesk_add_category_model',
        ];

        $clients = HelpdeskCategory::all();
        foreach ($clients as $row) {
            $response[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }
        return response()->json($response);
    }

    public function getHelpdeskStatus(Request $request)
    {
        $search = $request->search; // Ajax Search

        $response = [];
        $response[] = [
            'id' => 'add_new',
            'text' => 'Add New',
            'modal' => 'helpdesk_add_status_model',
        ];

        $clients = HelpdeskStatus::all();
        foreach ($clients as $row) {
            $response[] = [
                'id' => $row->id,
                'text' => $row->name,
            ];
        }
        return response()->json($response);
    }

    public function addComment(Request $request)
    {
        $msg = '';
        $id = $request->input('helpdesk_ticket_id');
        $validated = $request->validate([
            'helpdesk_ticket_id' => 'required',
            'helpdesk_comment' => 'required',
        ]);

        HelpdeskComment::create([
            'ticket_id' => $request->input('helpdesk_ticket_id'),
            'content' => $request->input('helpdesk_comment'),
            'user_id' => auth()->user()->id,
            'status' => 1,
        ]);
        $msg = 'Comment Added Successfully!!!!';
        $this->activity($id, 'comment');

        return back()->with(['success' => $msg]);
    }

    public function addClient(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|unique:helpdesk_clients,name,' . $id . '|max:255',
        ]);
        if ($id > 0) {
            HelpdeskClient::whereId($id)->update(['name' => $request->input('name')]);
            $msg = 'Client Updated Successfully!!!!';
        } else {
            HelpdeskClient::create(['name' => $request->input('name')]);
            $msg = 'Client Added Successfully!!!!';
        }

        return response()->json(['success' => $msg]);
    }

    public function addCategory(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|unique:helpdesk_categories,name,' . $id . '|max:255',
        ]);
        if ($id > 0) {
            HelpdeskCategory::whereId($id)->update(['name' => $request->input('name')]);
            $msg = 'Category Updated Successfully!!!!';
        } else {
            HelpdeskCategory::create(['name' => $request->input('name')]);
            $msg = 'Category Added Successfully!!!!';
        }

        return response()->json(['success' => $msg]);
    }

    public function addStatus(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|unique:helpdesk_statuses,name,' . $id . '|max:255',
        ]);
        if ($id > 0) {
            HelpdeskStatus::whereId($id)->update(['name' => $request->input('name')]);
            $msg = 'Status Updated Successfully!!!!';
        } else {
            HelpdeskStatus::create(['name' => $request->input('name')]);
            $msg = 'Status Added Successfully!!!!';
        }

        return response()->json(['success' => $msg]);
    }

    public function addPriority(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|unique:helpdesk_priorities,name,' . $id . '|max:255',
        ]);
        if ($id > 0) {
            HelpdeskPriority::whereId($id)->update(['name' => $request->input('name')]);
            $msg = 'Priority Updated Successfully!!!!';
        } else {
            HelpdeskPriority::create(['name' => $request->input('name')]);
            $msg = 'Priority Added Successfully!!!!';
        }

        return response()->json(['success' => $msg]);
    }

    public function addProject(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|unique:helpdesk_projects,name,' . $id . '|max:255',
        ]);
        if ($id > 0) {
            HelpdeskProject::whereId($id)->update(['name' => $request->input('name')]);
            $msg = 'Project Updated Successfully!!!!';
        } else {
            HelpdeskProject::create(['name' => $request->input('name')]);
            $msg = 'Project Added Successfully!!!!';
        }

        return response()->json(['success' => $msg]);
    }

    public function activity($ticket_id, $type, $msg = '')
    {
        $activity = $type;
        $description = '';

        $iconCls = 'ri-file-text-line';
        switch ($type) {
            case 'new':
                $description = 'New Ticket Created';
                break;
            case 'title':
                $description = 'Title Updated';
                break;
            case 'description':
                $description = 'Description Updated';
                break;
            case 'html':
                $description = 'Html Content Updated';
                break;
            case 'edit':
                $description = 'Ticket Edited';
                break;
            case 'comment':
                $description = 'Commented on ticket';
                break;
            case 'status':
                $description = 'changed the status';
                break;
            case 'client':
                $description = 'changed the client';
                break;
            case 'project':
                $description = 'changed the Project';
                break;
            case 'category':
                $description = 'changed the Category';
                break;
            case 'priority':
                $description = 'changed the Priority';
                break;
            case 'assignee':
                $description = 'Changed the assignee';
                break;
            case 'attachment':
                $description = 'Uploaded Image';
                break;
            case 'del_attachment':
                $description = 'Deleted Image';
                break;

            default:
                $description = 'Ticket Updated';
        }
        if ($msg != '') {
            $description = $msg;
        }

        if ($type == 'attachment' || $type == 'assignee') {
            $html = $description;
        } else {
            $html =
                '<p class="text-muted mb-0">
        <i class="' .
                $iconCls .
                ' align-middle"></i>
        ' .
                $description .
                '
        </p>';
        }

        HelpdeskActivity::create([
            'ticket_id' => $ticket_id,
            'user_id' => auth()->user()->id,
            'activity' => $activity,
            'description' => $html,
            'status' => 1,
        ]);
        $this->lastActivity($ticket_id);

        $ticket_assignee_list = HelpdeskAssign::where('ticket_id', $ticket_id)->pluck('user_id');

        $users_list = User::whereIn('id', $ticket_assignee_list)->get();
        $helpdeskTicket = HelpdeskTicket::where('id', $ticket_id)->first();

        $data = (object) [
            'type' => $activity,
            'msg' => $description,
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->name,
            'link' => route('viewticket', $helpdeskTicket->ticket_no),
        ];

        Notification::send($users_list, new \App\Notifications\HelpdeskActivity($data));
    }

    public function lastActivity($ticket_id)
    {
        HelpdeskTicket::where('id', $ticket_id)->update(['last_Activity' => Carbon::now()]);
    }

    public function getPriorityName($id)
    {
        return HelpdeskPriority::where('id', $id)
            ->pluck('name')
            ->first();
    }

    public function getCategoryName($id)
    {
        return HelpdeskCategory::where('id', $id)
            ->pluck('name')
            ->first();
    }

    public function getClientName($id)
    {
        return HelpdeskClient::where('id', $id)
            ->pluck('name')
            ->first();
    }

    public function getStatusName($id)
    {
        return HelpdeskStatus::where('id', $id)
            ->pluck('name')
            ->first();
    }

    public function getProjectName($id)
    {
        return HelpdeskProject::where('id', $id)
            ->pluck('name')
            ->first();
    }
    public function getUserName($id)
    {
        return User::where('id', $id)
            ->pluck('name')
            ->first();
    }
}
