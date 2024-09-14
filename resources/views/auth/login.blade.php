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
                                    {{-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input"  value="siswa" name="fooby[1][]" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Siswa</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input"  value="siswa" name="fooby[1][]" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Guru</label>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="container mt-5"> --}}
                                        <div class="row container">
                                            <div class="container col-sm-8">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox small">
                                                        <input type="checkbox" class="custom-control-input" value="siswa" name="fooby[1][]" id="customCheck">
                                                        <label class="custom-control-label" for="customCheck">Siswa</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container col-sm-3">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox small">
                                                        <input type="checkbox" class="custom-control-input" value="guru" name="fooby[1][]" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Guru</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </div> --}}
{{-- 
                                    <div>
                                        <h3>Fruits</h3>
                                        <label>
                                          <input type="checkbox" class="radio" value="1" name="fooby[1][]" />Kiwi</label>
                                        <label>
                                          <input type="checkbox" class="radio" value="1" name="fooby[1][]" />Jackfruit</label>
                                        <label>
                                          <input type="checkbox" class="radio" value="1" name="fooby[1][]" />Mango</label>
                                      </div> --}}
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
    // the selector will match all input controls of type :checkbox
// and attach a click event handler 
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>
@endsection