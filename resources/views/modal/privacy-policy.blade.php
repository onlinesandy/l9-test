@if (Cookie::get('privacy-policy-cookie') == '')
    <button id="privacyPolicyModalBtn" type="button" class="btn btn-primary" data-bs-toggle="modal" style="display:none;"
        data-bs-target="#privacyPolicyModal">
        Static Backdrop Modal
    </button>
    <div class="modal fade" id="privacyPolicyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon src="https://cdn.lordicon.com/yyecauzv.json" trigger="loop"
                        colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                    </lord-icon>

                    <div class="mt-4">
                        <h4 class="mb-3">Privacy & Policy</h4>
                        <p class="text-muted mb-4"> Please Accept the Privacy and Policy</p>
                        <div class="hstack gap-2 justify-content-center">
                            <form method="POST" action="{{ route('setPrivacyPolicyCookie') }}">
                                @csrf
                                <button type="submit" class="btn btn-info fw-medium" data-bs-dismiss="modal"
                                    id="acceptPrivacyPolicyBtn">
                                    <i class="ri-checkbox-line me-1 align-middle"></i> Accept
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("privacyPolicyModalBtn").click();
        });
    </script>
@endif
