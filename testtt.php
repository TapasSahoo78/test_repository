
$(document).on('submit', '.adminFrm', function (event) {
    event.preventDefault();
    let formdata = new FormData(this);
    $.ajax({
        type: "POST",
        url: $(this).data('action'),
        data: formdata,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (data) {
            if (data.status) {
                if (data.message != '') {
                    $.alert({
                        icon: 'fa fa-check',
                        title: 'Success!',
                        content: data.message,
                        type: 'green',
                        typeAnimated: true,
                    });
                }
                if (data.redirect != '') {
                    setTimeout(function () {
                        window.location.href = data.redirect
                    }, 1000);
                }
            } else {
                $.alert({
                    icon: 'fa fa-warning',
                    title: 'Warning!',
                    content: data.message,
                    type: 'orange',
                    typeAnimated: true,
                });
            }
        }
    });
});

$(document).on('click', '.change-status', function () {
    var id = $(this).data('id');
    var keyId = $(this).data('key');
    var table = $(this).data('table');
    var status = $(this).data('status');
    var url = $(this).data('action');
    var field = $(this).data('field');

    // alert(id + keyId + table + status + url);

    var dataJSON = {
        id: id,
        keyId: keyId,
        table: table,
        status: status,
        field: field,
        _token: _token
    };
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Do you really want to do this ?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () {
                if (id && table) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: dataJSON,
                        dataType: "JSON",
                        success: function (data) {
                            console.log(data);
                            if (data.status) {
                                if (data.postStatus == '2') {
                                    $.alert({
                                        icon: 'fa fa-check',
                                        title: 'Success!',
                                        content: 'Data has been deleted !',
                                        type: 'green',
                                        typeAnimated: true,
                                    });
                                    setTimeout(function () { location.reload() }, 1550);

                                } else if (data.postStatus == '1') {
                                    $('#' + id).removeClass('badge-danger');
                                    $('#' + id).addClass('badge-primary');
                                    $('#' + id).html('Active');
                                    $('#' + id).data('status', '0');
                                    $.alert({
                                        icon: 'fa fa-check',
                                        title: 'Success!',
                                        content: data.message,
                                        type: 'green',
                                        typeAnimated: true,
                                    });
                                    setTimeout(function () { location.reload() }, 1550);
                                } else if (data.postStatus == '0') {

                                    $('#' + id).removeClass('badge-primary');
                                    $('#' + id).addClass('badge-danger');
                                    $('#' + id).html('Inactive');
                                    $('#' + id).data('status', '1');

                                    $.alert({
                                        icon: 'fa fa-check',
                                        title: 'Success!',
                                        content: data.message,
                                        type: 'green',
                                        typeAnimated: true,
                                    });
                                    setTimeout(function () { location.reload() }, 1550);

                                } else if (data.postStatus == '5') {

                                    $('#' + id).removeClass('badge-primary');
                                    $('#' + id).addClass('badge-danger');
                                    $('#' + id).html('Inactive');
                                    $('#' + id).data('status', '1');

                                    $.alert({
                                        icon: 'fa fa-close',
                                        title: 'Warning !',
                                        content: data.message,
                                        type: 'orange',
                                        typeAnimated: true,
                                    });
                                    setTimeout(function () { location.reload() }, 7000);

                                }

                            }
                        }
                    });
                }
            },
            cancel: function () {
                $.alert({
                    icon: 'fa fa-times',
                    title: 'Canceled!',
                    content: 'Process canceled',
                    type: 'purple',
                    typeAnimated: true,
                });
            }
        }
    });
});

$(document).on('keypress', '.float-number', function (event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});









<td class="text-center">
                                    @if ($olc->is_active == 1)
                                        <a href="javascript:void(0)" data-table="car_types" data-status="0"
                                            data-field="is_active" data-key="id" data-id="{{ $olc?->id }}"
                                            class="btn btn-success btn-md change-status p-1"
                                            data-action="{{ route('admin.status.change') }}"><strong>Active</strong></a>
                                    @else
                                        <a href="javascript:void(0)" data-table="car_types" data-status="1"
                                            data-field="is_active" data-key="id" data-id="{{ $olc?->id }}"
                                            class="btn btn-danger btn-md change-status p-1"
                                            data-action="{{ route('admin.status.change') }}"><strong>Inactive</strong></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.car.type.edit', Crypt::encrypt($olc?->id)) }}"><i
                                            class="fa fa-pencil"></i>
                                    </a>

                                    <a href="javascript:void(0)" data-table="car_types" data-status="1"
                                        data-field="deleted_at" data-key="id" data-id="{{ $olc?->id }}"
                                        class="change-status p-1" data-action="{{ route('admin.status.change') }}">
                                        <i class="fa fa-trash" style="color: red"></i></a>
                                </td>





public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'keyId' => 'required',
            'status' => 'required',
            'table' => 'required',
            'field' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => FALSE,
                    'message' => $validator->errors()->first(),
                    'redirect' => ''
                ],
                200
            );
        }
        try {
            $updateData = [$request->field => $request->field == 'deleted_at' ? Carbon::now() : $request->status];
            DB::table($request->table)->where($request->keyId, $request->id)->update($updateData);

            if ($request->field == 'is_verified') {
                $user = User::where('id', $request->id)->select('fcm_token', 'is_verified')->first();
                sendNotification($user?->fcm_token, $request->status == 0 ? 'Account temporarily deactivate.Please contact with Admin!' : 'Account is Verified', $user?->is_verified);
            }

            return response()->json(
                [
                    'status' => TRUE,
                    'message' => $request->field == 'deleted_at' ? 'Deleted successfully' : 'Status updated successfully',
                    'redirect' => "",
                    'postStatus' => $request->status
                ],
                200
            );
        } catch (\Exception $e) {
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
            return response()->json([
                'status' => FALSE,
                'message' => 'Something Went Terribly Wrong.',
                'redirect' => ''
            ], 500);
        }
    }
