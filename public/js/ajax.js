$(document).ready(function(){

    var url = $('#url').val();

    $('#btn-add').click(function() {
        $('#btn-save').val("add");
        $('#listingForm').trigger("reset");
        $('.is-condemn').hide();
        $('.not-condemn').show();
        $('.modal-footer button').addClass("btn-primary").text("Save Changes");
        $('.modal-footer button').removeClass("btn-warning");
        $('#myModal').modal('show');
    });

    $(document).on('click', '.open-modal', function(){

        var listing_id = $(this).val();
        $.ajax({
            type: "GET",
            url: url + '/' + listing_id,
            success: function(data) {
                $('#listing_id').val(data.id);
                $('#inventory_no').val(data.inventory_no);
                $('#quantity').val(data.quantity);
                $('#cost').val(data.cost);
                $('#description').val(data.description);
                $('#date').val(data.date);
                $('#condemn').val(data.condemn);
                $('#reason').val(data.reason);
                $('.modal-footer button').addClass("btn-primary").text("Save Changes");
                $('.modal-footer button').removeClass("btn-warning");
                $('#btn-save').val("update");
                $('.is-condemn').hide();
                $('.not-condemn').show();
                $('#myModal').modal('show');
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click', '.btn-condemn', function() {

        var listing_id = $(this).val();
        $.ajax({
            type: "GET",
            url: url + '/' + listing_id,
            success: function(data) {
                $('#listing_id').val(data.id);
                $('#inventory_no').val(data.inventory_no);
                $('#quantity').val(data.quantity);
                $('#cost').val(data.cost);
                $('#description').val(data.description);
                $('#date').val(data.date);
                $('#condemn').val("1");
                $('#reason').val(data.reason);
                $('.modal-footer button').removeClass("btn-primary").text("Save Changes");;
                $('.modal-footer button').addClass("btn-warning").text("CONDEMN");
                $('#btn-save').val("condemn");
                $('.is-condemn').show();
                $('.not-condemn').hide();
                $('#myModal').modal('show');
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('#btn-save').click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var listingData = {
            inventory_no: $('#inventory_no').val(),
            quantity: $('#quantity').val(),
            cost: $('#cost').val(),
            description: $('#description').val(),
            date: $('#date').val(),
            condemn: $('#condemn').val(),
            reason: $('#reason').val(),
        }

        var state = $('#btn-save').val();
        var type = "POST";
        var listing_id = $('#listing_id').val();
        var my_url = url;
        if(state == "update") {
            type = "PUT";
            my_url += '/' + listing_id;
        } else if(state == "condemn") {
            type = "PUT";
            my_url += '/' + listing_id;
        }

        $.ajax({
            type: type,
            url: my_url,
            data: listingData,
            dataType: 'json',
            success: function(data) {
                if($.isEmptyObject(data.errors)) {
                    var listing = '<tr class="alternate" id="listing' +data.id+ '">';
                    listing += '<td>' +data.inventory_no+ '</td>';
                    listing += '<td>' +data.quantity+ '</td>';
                    listing += '<td>' +data.cost+ '</td>';
                    listing += '<td>' +data.cost * data.quantity+ '</td>';
                    listing += '<td>' +data.description+ '</td>';
                    listing += '<td>' +data.date+ '</td>';
                    listing += '@cannot("isAdmin")';
                    listing += '<td width="5px" class="d-print-none"> <button class="btn btn-info btn-sm open-modal" value="'+data.id+'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button></td>';
                    listing += '<td width="5px" class="d-print-none"> <button class="btn btn-danger btn-sm btn-delete" value="'+data.id+'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button> </td>';
                    listing += '<td width="5px" class="d-print-none"> <button class="btn btn-warning btn-sm btn-condemn" value="'+data.id+'" data-toggle="tooltip" data-placement="top" title="Condemn"><i class="fas fa-minus-circle"></i></button> </td>';
                    listing += '@endcan';
                    listing += '</tr>';
                    if(state == "add") {
                        $('#table-body').append(listing);
                    } 
                    else if(state == "condemn") {
                        $('#condemn-body').append(listing);
                        $('#listing'+listing_id).remove();
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                    else {
                        $('#listing'+listing_id).replaceWith(listing);
                    }
                
                    $('#my-alert').html('<div class="alert alert-success">Item Saved!</div>');
                }
                else {
                    printErrorMsg(data);
                }
                $('.alert').delay(1000).fadeOut(2000);
                $('#listingForm').trigger("reset");
                $('#myModal').modal('hide');
            }
        });
    });

    $(document).on('click', '.btn-delete', function() {

        var listing_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url + '/' + listing_id,
            type: "DELETE",
            success: function(data) {
                console.log(data);
                $('#listing' + listing_id).remove();
                $('#my-alert').html('<div class="alert alert-danger">Item Removed!</div>');
                $('.alert').delay(2000).fadeOut(2000);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });


    $('#search').on('keyup', function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $value = $(this).val();

        $.ajax({
            url: '/search',
            type: "GET",
            data: {'search': $value},
            success: function(data) {
                $('#table-body').html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('#searchCondemn').on('keyup', function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $value = $(this).val();

        $.ajax({
            url: '/searchC',
            type: "GET",
            data: {'searchCondemn': $value},
            success: function(data) {
                $('#condemn-body').html(data);
                
                $('[data-toggle="tooltip"]').tooltip();
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('.add-dept').click(function(){
        $('#dept-modal').modal('show');
    });

    $('#btn-save-dept').click(function(e){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            }
        });

        e.preventDefault();

        $.ajax({
            url: '/storeDept',
            type: 'POST',
            data: {
                'department_name': $('#department_name').val(),
            },
            success: function(data) {
            if($.isEmptyObject(data.errors)) {
                

                var department = '<tr class="alternate" id="role' +data.id+ '">';
                department += '<td>' +data.role+ '</td>';
                department += '</tr>';

                $('#department-body').append(department);
                $('.alert').delay(1000).fadeOut(2000);
            }
            else {
                printErrorMsg(data);
            }
            $('#deptForm').trigger("reset");
            $('#dept-modal').modal('hide');

            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    function printErrorMsg(data) {
        $.each(data, function(key, value){
            $('.alert-danger').show();
            $('.alert-danger').append('<p>'+value+'</p>');
        });
        $('.alert').delay(4000).fadeOut(2000);
    }
});