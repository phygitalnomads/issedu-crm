@extends('voyager::master')
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->

@section('content')
    <h3 style="text-align: center"><a href="/admin/utilizator">Detalii</a></h3>
    <?php //echo $user->name ?>
    <?php //echo $student->name ?>
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        
        <?php /*if (isset($user)) : ?>
          <div class="container">
                <h2>Bun venit {{$user->name}} </h2>
                <p>Paragraf de test</p>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>John</td>
                      <td>Doe</td>
                      <td>john@example.com</td>
                    </tr>
                    <tr>
                      <td>Mary</td>
                      <td>Moe</td>
                      <td>mary@example.com</td>
                    </tr>
                    <tr>
                      <td>July</td>
                      <td>Dooley</td>
                      <td>july@example.com</td>
                    </tr>
                  </tbody>
                </table>
          </div>
        <?php endif; */ ?>

        <?php if (isset($utilizator)) : ?>
          <div class="container">
          <h2>Bun venit {{$utilizator['Name']}} </h2>
              <p>Test</p>
                <table class="table table-hover">
                  <tbody>
                  <?php foreach ($utilizator as $key => $value) : ?>
                    <tr>
                      <th>{{$key}}</th>
                      <th>{{$value}}</th>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
          </div>
        <?php endif; ?>

        <?php if (isset($profesor)) : ?>
          <div class="container">
          <h2>Bun venit {{$profesor['Name']}} </h2>
              <p>Test</p>
                <table class="table table-hover">
                  <tbody>
                  <?php foreach ($profesor as $key => $value) : ?>
                    <tr>
                      <th>{{$key}}</th>
                      <th>{{$value}}</th>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
          </div>
        <?php endif; ?>

    </div>
@stop