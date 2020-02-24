@extends('voyager::master')
<!--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.2/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.2/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.2/dist/js/uikit-icons.min.js"></script>

@section('content')
    <!-- <h3 style="text-align: center"><a href="/admin/utilizator">Detalii</a></h3> -->
    <!-- <h3 style="text-align: center"><a href="/admin/profesor">Test Profesor cu id-ul 41576 din crm(mediu test)</a></h3> -->
    <?php //echo $user->name ?>
    <?php //dd($data) ?>
    <div class="page-content container">
        @include('voyager::alerts')
        @include('voyager::dimmers')


        <?php //dd($data); ?>

        <?php if (isset($data)) : ?>
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

                <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>

                    <?php foreach ($data['Carduri'] as $card) : ?>

                    <div uk-button uk-button-default href="#modal-container<?= $card['Tabara']['Id']?>" uk-toggle>
                        <div class="uk-card uk-card-hover uk-card-body uk-card-default">
                            <h3 class="uk-card-title"><?= $card['Tabara']['NumeTabara2'] ?></h3>
                            <p>
                                <table class="uk-table uk-table-responsive uk-padding-small uk-table-small">
                                    <tbody>
                                    <tr>
                                        <td>Destinatie</td>
                                        <td><?= $card['Tabara']['Tara'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Data Tabara</td>
                                        <td><?= strtok($card['Tabara']['DataIncepereTabara2'], ' ') ;?></td>
                                    </tr>
                                    <tr>
                                        <td>Nume</td>
                                        <td><?= $card['Contact']['FirstName'].' '.$card['Contact']['LastName'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Indrumator</td>
                                        <td><?= $card['Tabara']['ProfesorProfesoriIndrumatori'] ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                        <div id="modal-container<?= $card['Tabara']['Id']?>" class="uk-modal-container" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body">
                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                <h2 class="uk-modal-title"><?= $card['Tabara']['Name'] ?></h2>

                                <ul uk-accordion>
                                    <li class="uk-open">
                                        <a class="uk-accordion-title" href="#">Informatii personale</a>
                                        <div class="uk-accordion-content">
                                            <table class="uk-table uk-table-responsive uk-table-divider">
                                                <tbody>
                                                <tr>
                                                    <td>name</td>
                                                    <td>Table Data</td>
                                                </tr>
                                                <tr>
                                                    <td>name</td>
                                                    <td>Table Data</td>
                                                </tr>
                                                <tr>
                                                    <td>name</td>
                                                    <td>Table Data</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="uk-accordion-title" href="#">Date tabara</a>
                                        <div class="uk-accordion-content">
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="uk-accordion-title" href="#">Financiar</a>
                                        <div class="uk-accordion-content">
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="uk-accordion-title" href="#">Transport</a>
                                        <div class="uk-accordion-content">
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>


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
        <?php endif; ?>

        <?php if (!isset($data)) : ?>
        <h2 style="text-align:center"> Momentan nu avem detalii despre acest cont </h2>
        <h2 style="text-align:center"><a href='/admin/utilizator'>Reincearca</a></h2>
        <?php endif; ?>


        aici
    </div>
@stop
