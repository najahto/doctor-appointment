<div class="modal fade" id="detailModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalModalLabel">Doctor information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2 image-display">
                    @if ($user->picture)
                        <img class="w-50 picture-margin" src="{{ asset('storage/' . $user->picture) }}"
                            alt="user picture">
                    @else
                        <img class="w-50 picture-margin" src="{{ asset('admin-template/img/undraw_profile.svg') }}"
                            width="200" alt="No picture to show">
                    @endif
                </div>
                <div class="mb-2 d-flex">
                    <h4 class="font-weight-normal">{{ $user->name }}</h4>
                    <div class="d-flex ml-auto">
                        <p class="badge  badge-info">Role : {{ $user->role->name }}</p>
                    </div>
                </div>

                <div class="mb-2">
                    <ul class="list-unstyled">
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">Email:</span>
                            <label class="media-body">{{ $user->email }}</label>
                        </li>
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">Gender: </span>
                            <label class="media-body">{{ $user->gender }}</label>
                        </li>
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">Phone: </span>
                            <label class="media-body">{{ $user->phone_number }}</label>
                        </li>
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">Address: </span>
                            <label class="media-body">{{ $user->address }}</label>
                        </li>
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">Specialist: </span>
                            <label class="media-body">{{ $user->department }}</label>
                        </li>
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">Education: </span>
                            <label class="media-body">{{ $user->education }}</label>
                        </li>
                        <li class="media">
                            <span class="w-25 text-black font-weight-normal">About: </span>
                            <label class="media-body">{{ $user->description }}</label>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
