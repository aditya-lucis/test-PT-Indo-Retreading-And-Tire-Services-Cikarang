@extends('layout.master')

@section('css')
<!-- Bootstrap CSS & JS (sesuai versi yang Anda pakai) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap Timepicker CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
<link href="{{ asset('assets/master/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">List of Product</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" id="btn-add"><i class="typcn typcn-plus"></i> New Product </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- // modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Brand</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save" style="display: none;">Save changes</button>
                <button type="button" class="btn btn-primary" id="btn-update" style="display: none;">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addtocartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add To Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addtoCart">
                    @csrf
                    <div class="form-group">
                        <label for="nametocart">Nama</label>
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" id="maxstock">
                        <input type="hidden" id="customer_id">
                        <input type="text" class="form-control" id="nametocart" name="nametocart" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="brandtocart">Brand</label>
                        <input type="text" class="form-control" id="brandtocart" name="brandtocart" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="pricetocart">Price</label>
                        <input type="number" class="form-control" id="pricetocart" name="pricetocart" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="qty">QTY</label>
                        <input type="number" class="form-control" id="qty" name="qty" required>
                    </div>
                    <div class="form-group">
                        <label for="qty">Total</label>
                        <input type="number" class="form-control" id="total" name="total" readonly required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-addtochart" style="display: none;">Add To Cart</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script-bottom')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script src="{{ asset('assets/master/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/master/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function () {
        var datatable = $('#dataTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns:[
                { "data": 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, row) {
                        return Number(data).toLocaleString('id-ID');
                    }
                },
                { data: 'stock', name: 'stock' },
                { data: 'action', name: 'action', orderable: false, searchable: false, width: '15%' }
            ]
        })
    })
</script>

<script>
    $('body').on('click', '#btn-add', function() {
        $('#addModal').modal('show');

        $('#name').val("")
        $('#description').val("")
        $('#price').val("0")
        $('#stock').val("0")

        $('#btn-save').show();   // Tampilkan tombol Simpan
        $('#btn-update').hide(); // Sembunyikan tombol Update
    });

    $('#btn-save').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('products.store') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                name: $('#name').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                stock: $('#stock').val(),
            },
                success: function(response){
                    if (response.success) {
                        Swal.fire("Berhasil!", response.message, "success");
                        $('#addModal').modal('hide');
                        $('#dataTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire("Gagal!", response.message || "Terjadi kesalahan!", "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
                    console.log(xhr.responseText); // Debugging
                }
        })
    })

    $('body').on('click', '#edit', function(e) {
        e.preventDefault();
        
        let id = $(this).data('id');

        $.ajax({
            url: "{{ route('products.edit', ':id') }}".replace(':id', id),
            type: "GET",
            success: function(response){
                $('#name').val(response.name);
                $('#description').val(response.description);
                $('#price').val(response.price);
                $('#stock').val(response.stock);
                $('#btn-save').hide();   // Sembunyikan tombol Simpan
                $('#btn-update').show(); // Tampilkan tombol Update

                // Tambahkan input hidden untuk idproduct jika belum ada
                if ($('#idproduct').length === 0) {
                    $('#addForm').prepend('<input type="hidden" id="idproduct" name="idproduct" value="' + response.id + '">');
                } else {
                    $('#idproduct').val(response.id);
                }

                $('#addModal').modal('show');
            }
        })
    })

    $('#btn-update').on('click', function(e){
        e.preventDefault();

        var id = $('#idproduct').val();

        $.ajax({
            url: "{{ route('products.update', ':id') }}".replace(':id', id),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PUT",
                name: $('#name').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                stock: $('#stock').val(),
            },
                success: function(response){
                    if (response.success) {
                        Swal.fire("Berhasil!", response.message, "success");
                        $('#addModal').modal('hide');
                        $('#dataTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire("Gagal!", response.message || "Terjadi kesalahan!", "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
                    console.log(xhr.responseText); // Debugging
                }
        })
    })

    $('body').on('click', '#delete', function(e){
        e.preventDefault();
        
        let id = $(this).data('id');

        if (confirm("Yakin ingin menghapus data ini?")) {
            $.ajax({
                url: "{{ route('products.destroy', ':id') }}".replace(':id', id),
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if (response.success) {
                        Swal.fire("Berhasil!", response.message, "success");
                        $('#addModal').modal('hide');
                        $('#dataTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire("Gagal!", response.message || "Terjadi kesalahan!", "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
                }
            })
        }
    })

    $('body').on('click', '#addchart', function(e){
        e.preventDefault()
        
        let id = $(this).data('id')

        $.ajax({
            url: "{{ route('products.edit', ':id') }}".replace(':id', id),
            type: "GET",
            success: function(response){
                $('#product_id').val(response.id)
                $('#nametocart').val(response.name)
                $('#brandtocart').val(response.description)
                $('#pricetocart').val(response.price)
                $('#qty').val(1)
                $('#maxstock').val(response.stock)
                $('#customer_id').val("{{ auth()->user()->id }}");
                $('#btn-addtochart').show();

                let price = parseFloat($('#pricetocart').val())
                let qty = parseFloat($('#qty').val())

                totalvalue = price * qty

                $('#total').val(totalvalue)

                $('#addtocartModal').modal('show')
            }
        })
    })

    $('body').on('input', '#qty', function () {

        let max = parseInt($('#maxstock').val());
        let qty = parseInt($(this).val());
        let price = parseFloat($('#pricetocart').val());

        // Jika qty melebihi stok → set ke stok
        if (qty > max) {
            qty = max;
            $(this).val(max);
        }

        // Jika qty kurang dari 1 → set ke 1
        if (qty < 1 || isNaN(qty)) {
            qty = 1;
            $(this).val(1);
        }

        // Hitung total
        $('#total').val(qty * price);
    });

    $('#addtocartModal').on('hidden.bs.modal', function () {
        $('#product_id').val('');
        $('#nametocart').val('');
        $('#brandtocart').val('');
        $('#pricetocart').val('');
        $('#qty').val('');
        $('#total').val('');
        $('#maxstock').val('');
        $('#customer_id').val('');
    });

    $('#btn-addtochart').on('click', function(e) {
        e.preventDefault()

        $.ajax({
            url: "{{ route('addToCart') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                customer_id: $('#customer_id').val(),
                product_id: $('#product_id').val(),
                quantity: $('#qty').val()
            },
                success: function(response){
                    if (response.success) {
                        Swal.fire("Berhasil!", response.message, "success");
                        $('#addtocartModal').modal('hide');
                    } else {
                        Swal.fire("Gagal!", response.message || "Terjadi kesalahan!", "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Error!", "Terjadi kesalahan pada server!", "error");
                    console.log(xhr.responseText); // Debugging
                }
        })
    })

</script>
@endsection