@if (count($bookings) > 0)
    <div class="modal fade" id="prescriptionModal{{ $booking->patient_id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('prescription.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Prescription</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Disease</label>
                            <input type="text" name="disease_name" class="form-control" placeholder="Disease">
                        </div>

                        <div class="form-group">
                            <label>Symptoms</label>
                            <textarea name="symptoms" class="form-control" placeholder="symptoms"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Medicine</label>
                            <div class="input-group mb-3">
                                <input type="text" name="medicine[]" class="form-control m-input"
                                    placeholder="Enter medicine name" autocomplete="off">
                                <div class="input-group-append">
                                    <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                </div>
                            </div>
                            <div id="newRow"></div>
                            <button id="addRow" type="button" class="btn btn-primary">Add more</button>
                        </div>
                        <div class="form-group">
                            <label>Procedure to use medicine</label>
                            <textarea name="procedure_to_use_medicine" class="form-control"
                                placeholder="Procedure to use medicine"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Feedback</label>
                            <textarea name="feedback" class="form-control" placeholder="feedback"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Signature</label>
                            <input type="text" name="signature" class="form-control" placeholder="Signature">
                        </div>

                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
