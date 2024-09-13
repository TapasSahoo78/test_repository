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
        <!-- Start Time Tab -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
            aria-labelledby="pills-home-tab">
            <div class="container mt-3">
                <div class="card">
                    <div class="card-body">
                        <!-- Vehicle Info -->
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Vehicle Number:</strong> MH04GZ9953</p>
                                <p><strong>Start Date & Time:</strong> 09-09-24 | 09:38 AM</p>
                            </div>
                        </div>

                        <!-- Photos Section -->
                        <div class="row mt-3">
                            <!-- Driver Photo -->
                            <div class="col-md-4">
                                <p><strong>Driver Photo</strong></p>
                                <div class="border bg-light"
                                    style="height: 150px; width: 100%; display: flex; justify-content: center; align-items: center;">
                                    <img src="driver_photo.jpg" alt="Driver Photo"
                                        class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                                </div>
                            </div>

                            <!-- First Car Meter -->
                            <div class="col-md-4">
                                <p><strong>First Car Meter</strong></p>
                                <img src="meter_photo.jpg" alt="First Car Meter" class="img-fluid">
                            </div>

                            <!-- Other Photos -->
                            <div class="col-md-4">
                                <p><strong>Other Photos</strong></p>
                                <div class="d-flex">
                                    <img src="other_photo1.jpg" alt="Other Photo 1"
                                        class="img-fluid me-2" style="max-width: 32%;">
                                    <img src="other_photo2.jpg" alt="Other Photo 2"
                                        class="img-fluid me-2" style="max-width: 32%;">
                                    <img src="other_photo3.jpg" alt="Other Photo 3"
                                        class="img-fluid" style="max-width: 32%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Time Tab -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
            aria-labelledby="pills-profile-tab">
            <!-- Similar layout for End Time (if required) -->
        </div>
    </div>
</div>