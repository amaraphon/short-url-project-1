@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="text-center">
                @if($message = Session::get('success'))
                    <h3 style="color: yellowgreen" >{{ $message }}</h3>
                @endif
            </div>
            <h5 class="card-title">
                <div class="d-flex justify-content-between">
                    <div>Your Quota Remaining {{ 15-count($urls) }}/15</div>
                    <div>
                        <a href="/new" class="btn btn-primary px-5">create</a>
                    </div>
                </div>
            </h5>
            @if(!$urls->isEmpty())
                <table class="table table-strip">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Long URL</th>
                        <th scope="col">Short URL</th>
                        <th scope="col">Create</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <input type="hidden" class="delete_val_id" value="{{ $url->id }}">
                            <td>{{ $url->id }}</td>
                            <td>{{ $url->long_url }}</td>
                            <td><a href="/gt/{{ $url->short_url }}" target="_blank">{{ $url->short_url }}</a></td>
                            <td>{{ $url->created_at }}</td>
                            <td>
                                <button class="btn btn-outline-danger servideletebtn">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.servideletebtn').click(function (e) {
            e.preventDefault();

            var delete_id = $(this).closest("tr").find('.delete_val_id').val();
            //alert(delete_id);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        };
                        $.ajax({
                           type: "DELETE",
                           url: '/delete/'+delete_id,
                           data: data,
                           success: function (response) {
                               swal(response.status, {
                                   icon: "success",
                               })
                               .then((result) => {
                                  location.reload();
                               });
                           }
                        });
                    }
                });
        });
    });
</script>
@endpush






