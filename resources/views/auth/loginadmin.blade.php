@extends('layouts.auth')
@section('container')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                @if(session()->has('loginError'))
                                <div class="alert alert-danger" role="alert">
                                {{ session('loginError') }}
                                </div>
                                @endif
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login!</h1>
                                </div>
                                <form class="user" action="/proseslogin" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="nik" class="form-control form-control-user"
                                            id="nik" aria-describedby="emailHelp"
                                            placeholder="Silahkan masukan Nik Anda..." autofocus required>
                                    </div>
                                    <div class="form-group ">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit" >   Login</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$("input:checkbox").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
    var group = "input:checkbox[name='" + $box.attr("name") + "']";

    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>
@endsection