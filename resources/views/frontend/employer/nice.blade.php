@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')
<section id="company-box">
    <div class="container">
       {!! Form::open(['action'=>['frontend\Employer@post'],'method'=>'post','class'=>'form-horizontal','files'=>true,'enctype'=>'multipart/form-data']) !!}
  <div class="form-group">
    <label for="exampleInputEmail1">goodscount</label>
    <input type="number" class="form-control"  name="goodscount" aria-describedby="emailHelp" placeholder="Enter email">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">name</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="goodsName" placeholder="Password">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">price</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="price" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">buyername</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="buyerName" placeholder="Password">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">tel</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="tel" aria-describedby="emailHelp" placeholder="Enter email">
  
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">email</label>
    <input type="email" class="form-control" id="exampleInputPassword1" name="Email" placeholder="Password">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection