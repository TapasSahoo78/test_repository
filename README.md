                <div class="modal-body generate-qr" style="">
                    <div class="qrcode_box generate-qr" id="generate-qr" style="">
                        <div class="qr_code" style="margin-left: 120px;padding: 15px;">
                            {!! DNS2D::getBarcodeHTML(Crypt::encrypt($stand->id), 'QRCODE', 4, 4, 'black', true) !!}
                        </div>
                    </div>
                    <div class="qr_download" style="margin-left: 130px;margin-top:15px;">
                        <button type="button" class="btn btn-success btn-qr download" id="download">Download
                            QR</button>
                        <button type="button" onclick="window.print()" class="btn btn-success btn-qrprint">Print
                            QR</button>
                    </div>
                </div>



            function screenshot() {
    html2canvas(document.getElementsByClassName("generate-qr")[0]).then(function (canvas) {
        console.log(canvas.toDataURL());
        downloadImage(canvas.toDataURL(), "qrcodestand.png");
    });
   }
