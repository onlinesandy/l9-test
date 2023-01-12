<div class="card">
    <div class="alert alert-info border-0 rounded-top rounded-0 m-0 d-flex align-items-center" role="alert">
        <div class="flex-grow-1 text-truncate"> <b>Info </b></div>
        <div class="flex-shrink-0">

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <th class="ps-0" scope="row">Full Name
                            :</th>
                        <td class="text-muted">{{auth()->user()->name}}</td>
                    </tr>
                    <tr>
                        <th class="ps-0" scope="row">Mobile :
                        </th>
                        <td class="text-muted">XXX XXX XXXX</td>
                    </tr>
                    <tr>
                        <th class="ps-0" scope="row">E-mail :
                        </th>
                        <td class="text-muted">{{auth()->user()->email}}
                        </td>
                    </tr>
                    <tr>
                        <th class="ps-0" scope="row">Location :
                        </th>
                        <td class="text-muted"> USA</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
