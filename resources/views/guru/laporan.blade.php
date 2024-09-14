@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Laporan Data Guru</h1>


            
            {{-- <form action="/laporan-data-cuti" method="GET" class="mb-3"> --}}
                <div class="row g-1">
                <div class="form-group col-sm-8 col-md-10 mb-4">
                    {{-- <label for="jk">Nik</label> --}}
                    <select class="form-control" name="year" id="year">
                        <option selected disabled> Silahkan Pilih Tahun</option>
                        @foreach(range(date('Y'), 2000) as $year)
                        @if(old('year')==$year)
                        <option value="{{ $year }}" selected>{{ $year }}</option>
                        @else
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                      <div class="col-4 col-md-1 ">
                          <button type="submit" id="tampil" class="btn btn-primary"> <i class="fas fa-search "></i></button>
                      </div>
                      </div>


                
            </div>
            <div id="tampil_transaksi" class="row"></div>
        
    </main>
    <script>
        $(function(){
         $("#tampil").click(function(){
            var year = $("#year").val();
            $.ajax({
               url:"/laporan-guru",
               type:"GET",
               data:"year="+year,
               cache:false,
               success:function(html){
               $("#tampil_transaksi").html(html);
               }
            })
             })
          
        })
     </script>
@endsection