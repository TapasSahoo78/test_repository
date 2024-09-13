<div class="location-top">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Start Time</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">End Time</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    @if (bookingLogAllStory($bookingDetails->id, 6)->isNotEmpty())
                                        @foreach (bookingLogAllStory($bookingDetails->id, 6) as $history)
                                            <div class="container mt-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><strong>Vehicle Number:</strong> MH04GZ9953</p>
                                                                <p><strong>Start Date & Time:</strong> 09-09-24 | 09:38 AM
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <p><strong>Driver Photo</strong></p>
                                                                <div class="border bg-light"
                                                                    style="height: 150px; width: 100%;"></div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p><strong>First Car Meter</strong></p>
                                                                <img src="meter_photo.jpg" alt="First Car Meter"
                                                                    class="img-fluid">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p><strong>Other Photo</strong></p>
                                                                <div class="d-flex">
                                                                    <img src="other_photo1.jpg" alt="Other Photo 1"
                                                                        class="img-fluid me-2">
                                                                    <img src="other_photo2.jpg" alt="Other Photo 2"
                                                                        class="img-fluid me-2">
                                                                    <img src="other_photo3.jpg" alt="Other Photo 3"
                                                                        class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    @if (bookingLogAllStory($bookingDetails->id, 3)->isNotEmpty())
                                        @foreach (bookingLogAllStory($bookingDetails->id, 3) as $history)
                                            <div class="container mt-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><strong>Vehicle Number:</strong> MH04GZ9953</p>
                                                                <p><strong>Start Date & Time:</strong> 09-09-24 | 09:38 AM
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <p><strong>Driver Photo</strong></p>
                                                                <div class="border bg-light"
                                                                    style="height: 150px; width: 100%;"></div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p><strong>First Car Meter</strong></p>
                                                                <img src="meter_photo.jpg" alt="First Car Meter"
                                                                    class="img-fluid">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p><strong>Other Photo</strong></p>
                                                                <div class="d-flex">
                                                                    <img src="other_photo1.jpg" alt="Other Photo 1"
                                                                        class="img-fluid me-2">
                                                                    <img src="other_photo2.jpg" alt="Other Photo 2"
                                                                        class="img-fluid me-2">
                                                                    <img src="other_photo3.jpg" alt="Other Photo 3"
                                                                        class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
