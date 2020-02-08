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
    <?php //dd($data) ?>
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')

        <?php //dd($data); ?>

          <div class="container">

            <?php if ($data['TipUser'] == 'Student') : ?>
              <?php if (isset($data['Carduri'])) : ?>
                <table class="table table-hover">
                    <tbody>
                    <?php foreach ($data['Carduri'] as $card) : ?>
                        <div>
                            <?php echo "Nume<br>"; var_dump($card['Nume']) ?>
                            <?php echo "Detalii<br>"; var_dump($card['Detalii']) ?>
                            <?php echo "Tabara<br>"; var_dump($card['Tabara']) ?>
                            <?php echo "Contact<br>"; var_dump($card['Contact']) ?>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
              <?php endif; ?>
            <?php endif; ?>

            <?php if ($data['TipUser'] == 'Profesor') : ?>
              <?php if (isset($data['Carduri'])) : ?>
                <table class="table table-hover">
                    <tbody>
                    <?php foreach ($data['Carduri'] as $card) : ?>
                    <div>
                        <?php echo "Nume<br>"; var_dump($card['Nume']) ?>
                        <?php echo "Detalii<br>"; var_dump($card['Detalii']) ?>
                        <?php echo "Tabara<br>"; var_dump($card['Tabara']) ?>
                        <?php echo "Contact<br>"; var_dump($card['Contact']) ?>
                    </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
              <?php endif; ?>
            <?php endif; ?>

            <?php if ($data['TipUser'] == 'ProfesorElev') : ?>
                <?php if (isset($data['Carduri'])) : ?>
                    <h2>Detalii Profesor</h2>
                    <table class="table table-hover">
                        <tbody>
                        <?php foreach ($data['Carduri'] as $card) : ?>
                        <div>
                            <?php echo "Nume<br>"; var_dump($card['Nume']) ?>
                            <?php echo "Detalii<br>"; var_dump($card['Detalii']) ?>
                            <?php echo "Tabara<br>"; var_dump($card['Tabara']) ?>
                            <?php echo "Contact<br>"; var_dump($card['Contact']) ?>
                        </div>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <?php if(isset($data['Elevi'])) : ?>
                    <h2>Detalii copii</h2>
                    <table class="table table-hover">
                        <tbody>
                        <?php foreach ($data['Elevi'] as $card) : ?>
                        <div>
                            <?php echo "Nume<br>"; var_dump($card['Nume']) ?>
                            <?php echo "Detalii<br>"; var_dump($card['Detalii']) ?>
                            <?php echo "Tabara<br>"; var_dump($card['Tabara']) ?>
                            <?php echo "Contact<br>"; var_dump($card['Contact']) ?>
                        </div>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

          </div>

        <?php if (!isset($data)) : ?>
        <h2 style="text-align:center"> Momentan nu avem detalii despre acest cont </h2>
        <h2 style="text-align:center"><a href='/admin/utilizator'>Reincearca</a></h2>
        <?php endif; ?>
    </div>
@stop
