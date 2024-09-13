<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-success text-white">
        <div class="d-flex justify-content-between">
          <button class="btn btn-light">Start Time</button>
          <button class="btn btn-light">End Time</button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Vehicle Number:</strong> MH04GZ9953</p>
            <p><strong>Start Date & Time:</strong> 09-09-24 | 09:38 AM</p>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <p><strong>Driver Photo</strong></p>
            <div class="border bg-light" style="height: 150px; width: 100%;"></div>
          </div>
          <div class="col-md-4">
            <p><strong>First Car Meter</strong></p>
            <img src="meter_photo.jpg" alt="First Car Meter" class="img-fluid">
          </div>
          <div class="col-md-4">
            <p><strong>Other Photo</strong></p>
            <div class="d-flex">
              <img src="other_photo1.jpg" alt="Other Photo 1" class="img-fluid me-2">
              <img src="other_photo2.jpg" alt="Other Photo 2" class="img-fluid me-2">
              <img src="other_photo3.jpg" alt="Other Photo 3" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>