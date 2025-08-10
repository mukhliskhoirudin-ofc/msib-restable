<!-- Modal -->
<div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger ">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Booking Your<span
                        class="description-title">Stay
                        With Us<br></span></h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.store') }}" method="post" role="form" id="formBooking"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="" selected disabled>-- Select Type --</option>
                            <option value="table" @selected(old('type') == 'table')>Table</option>
                            <option value="event" @selected(old('type') == 'event')>Event</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-4 col-md-6">
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Your Name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" id="email" placeholder="Your Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror "
                                name="phone" id="phone" placeholder="Your Phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="date" name="date"
                                class="form-control @error('date') is-invalid @enderror" id="date"
                                placeholder="Date" value="{{ old('date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="time" class="form-control @error('time') is-invalid @enderror"
                                name="time" id="time" placeholder="Time" value="{{ old('time') }}">
                            @error('time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <input type="number" class="form-control @error('people') is-invalid @enderror"
                                name="people" id="people" placeholder="# of people" min="1"
                                value="{{ old('people') }}">
                            @error('people')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                            id="file" accept="image/*">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5"
                            placeholder="Message">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="formBooking" class="btn btn-danger">Booking</button>
                </div>
            </div>
        </div>
    </div>
</div>
