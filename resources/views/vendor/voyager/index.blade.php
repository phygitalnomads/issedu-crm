@extends('voyager::master')
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->

@section('content')
    <!-- <h3 style="text-align: center"><a href="/admin/utilizator">Detalii</a></h3> -->
    <!-- <h3 style="text-align: center"><a href="/admin/profesor">Test Profesor cu id-ul 41576 din crm(mediu test)</a></h3> -->
    <?php //echo $user->name ?>
    <?php //dd($utilizator) ?>
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <?php //var_dump($business)?>


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
          <h2>Bun venit <?php echo $utilizator['Name'] ?> </h2>

            <?php if ($utilizator['TipUser']=='Student') : ?>
              <div class="list-group">
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Nume oferta tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['NumeTabara'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incepe tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataIncepereTabara'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incheiere tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataIncheiereTabara'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Nume indrumator grup</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['IndrumatorGrup2'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Oferta tabara</div>
                    <div class="col-sm-8 group_content"> Accesesaza link ? </div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Exemplu Program</div>
                    <div class="col-sm-8 group_content">Descarca</div>
                  </div>
                </a>
                <a href="<?php echo $utilizator['CopieCipasaport'] ?>" target="_blank" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Copie CI/pasaport</div>
                    <div class="col-sm-8 group_content">Descarca</div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Nr. telefon contact implicit</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['NrTelefon1'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data primei plati (data avans)</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataPrimeiPlati'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Incasare factura rest plata 1</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['IncasareFacturaRestPlata1'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incasare rest plata 1</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataFacturaRestPlata1'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Incasare factura rest plata 2</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['IncasareFacturaRestPlata2'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incasare rest plata 2</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataFacturaRestPlata2'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Sold final tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['Int1694'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Ultima actualizare</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['UpdatedAt'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Reduceri acordate</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['ReduceriAcordate'] ?></div>
                  </div>
                </a>
              </div>
              <?php /*
              <table class="table table-hover">
                <tbody>
                <?php foreach ($utilizator as $key => $value) : ?>
                  <tr>
                    <th><?php echo $key ?></th>
                    <th><?php echo $value ?></th>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
              <?php if (isset($business)) : ?>
                <p>Detaliile business</p>
                <table class="table table-hover">
                  <tbody>
                  <?php foreach ($business as $key => $value) : ?>
                    <tr>
                      <th><?php echo $key ?></th>
                      <th><?php echo $value ?></th>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              <?php endif; ?> */ ?>
            <?php endif; ?>

            <?php if ($utilizator['TipUser']=='Profesor') : ?>
              <div class="list-group">
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Nume oferta tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['NumeTabara'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incepe tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataIncepereTabara'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incheiere tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataIncheiereTabara'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Nume indrumator grup</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['IndrumatorGrup2'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Oferta tabara</div>
                    <div class="col-sm-8 group_content"> Accesesaza link ? </div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Exemplu Program</div>
                    <div class="col-sm-8 group_content">Descarca</div>
                  </div>
                </a>
                <a href="<?php echo $utilizator['CopieCipasaport'] ?>" target="_blank" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Copie CI/pasaport</div>
                    <div class="col-sm-8 group_content">Descarca</div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Nr. telefon contact implicit</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['NrTelefon1'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data primei plati (data avans)</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataPrimeiPlati'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Incasare factura rest plata 1</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['IncasareFacturaRestPlata1'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incasare rest plata 1</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataFacturaRestPlata1'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Incasare factura rest plata 2</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['IncasareFacturaRestPlata2'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Data incasare rest plata 2</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['DataFacturaRestPlata2'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Sold final tabara</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['Int1694'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Ultima actualizare</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['UpdatedAt'] ?></div>
                  </div>
                </a>
                <a href="#" class="list-group-item">
                  <div class="row">
                    <div class="col-sm-4 group_title">Reduceri acordate</div>
                    <div class="col-sm-8 group_content"><?php echo $utilizator['ReduceriAcordate'] ?></div>
                  </div>
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if (!isset($utilizator)) : ?>
        <h2 style="text-align:center"> Momentan nu avem detalii despre acest cont </h2>
        <h2 style="text-align:center"><a href='/admin/utilizator'>Reincearca</a></h2>
        <?php endif; ?>
    </div>
@stop
