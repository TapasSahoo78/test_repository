The issue seems to be related to how the `html2canvas` library captures the QR code and triggers the download. To debug this, ensure that `html2canvas` is correctly integrated and the `downloadImage` function works as intended. Here is an updated version of your code to help you troubleshoot and ensure that the QR code is downloaded properly:

1. Make sure to include `html2canvas` in your project.
2. Verify the `downloadImage` function is correctly defined.
3. Ensure the modal is fully rendered before attempting to capture the QR code.

Here's a revised version of your code:

```html
<div class="modal-body generate-qr" style="">
    <div class="qrcode_box generate-qr" id="generate-qr" style="">
        <div class="qr_code" style="margin-left: 120px;padding: 15px;">
            {!! DNS2D::getBarcodeHTML(Crypt::encrypt($stand->id), 'QRCODE', 4, 4, 'black', true) !!}
        </div>
    </div>
    <div class="qr_download" style="margin-left: 130px;margin-top:15px;">
        <button type="button" class="btn btn-success btn-qr download" id="download" onclick="screenshot()">Download QR</button>
        <button type="button" onclick="window.print()" class="btn btn-success btn-qrprint">Print QR</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
function screenshot() {
    html2canvas(document.getElementsByClassName("generate-qr")[0]).then(function(canvas) {
        console.log(canvas.toDataURL());
        downloadImage(canvas.toDataURL(), "qrcodestand.png");
    });
}

function downloadImage(data, filename) {
    var a = document.createElement('a');
    a.href = data;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
</script>
```

### Explanation:
1. **QR Code Generation**: Make sure the QR code is correctly rendered in the modal.
2. **html2canvas Integration**: Included the script for `html2canvas` and used it to capture the QR code.
3. **Download Function**: Added the `downloadImage` function to trigger the download of the captured image.
4. **Button Click**: Attached the `screenshot` function to the download button.

Ensure that `html2canvas` library version and usage align with your project requirements. If the issue persists, check for any console errors or warnings that might provide more insights.