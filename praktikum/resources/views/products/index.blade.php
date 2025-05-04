@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Management (AJAX)</h1>
    <button class="btn btn-success mb-2" id="createNewProduct">Add Product</button>
    <table class="table table-bordered" id="productTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Category</th>
                <th>Name</th>
                <th>Price</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="productForm" name="productForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modelHeading"></h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="product_id" id="product_id">
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" id="price" name="price" class="form-control" placeholder="Enter Price">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('page_script')
<script type="text/javascript">
$(function () {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.getProducts') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'category.name', name: 'category.name'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxProductModal').modal('show');
    });

    $('#productForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            data: $('#productForm').serialize(),
            url: "{{ route('products.store') }}",
            type: "POST",
            success: function (data) {
                $('#productForm').trigger("reset");
                $('#ajaxProductModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
      $.get("{{ url('products') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxProductModal').modal('show');
          $('#product_id').val(data.id);
          $('#name').val(data.name);
          $('#price').val(data.price);
          $('#category_id').val(data.category_id);
      })
    });

    $('body').on('click', '.deleteProduct', function () {
    var id = $(this).data("id");

    if (confirm("Are you sure want to delete?")) {
    $.ajax({
      type: "DELETE",
      url: "{{ url('products') }}/" + id,
      success: function (data) {
        table.draw();
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
});


});
</script>
@endsection
