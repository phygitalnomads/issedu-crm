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
              <?php /*
                <table class="table table-hover">
                    <tbody>
                    <?php foreach ($data['Carduri'] as $card) : ?>
                        <div>
                            <?php echo "Nume<br>"; var_dump($card['Nume']) ?>
                            <?php echo "Detalii<br>"; var_dump($card['Detalii']) ?>
                            <?php echo "Tabara<br>"; var_dump($card['Tabara']) ?>
                            <?php echo "Contact<br>"; var_dump($card['Contact']) ?>
                            <?php echo "Business<br>"; var_dump($card['Business']) ?>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                    */ ?>
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
                                        <td><b style="font-weight: 800;"><?= $card['Contact']['FirstName'].' '.$card['Contact']['LastName'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Indrumator</td>
                                        <td><?= $card['Tabara']['ProfesorProfesoriIndrumatori'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ultima actualizare</td>
                                        <td><?= $card['Detalii']['UpdatedAt'] ?></td>
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
                                                    <td>Nume</td>
                                                    <td><?= $card['Contact']['FirstName'].' '.$card['Contact']['LastName'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data nasterii</td>
                                                    <td><?= $card['Contact']['DataNasterii3'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sex</td>
                                                    <td><?= $card['Contact']['Sex'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>CNP</td>
                                                    <td><?= $card['Contact']['Cnp'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Cetatenie</td>
                                                    <td><?= $card['Contact']['Cetatenie'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Document de calatorie</td>
                                                    <td><?= $card['Contact']['DocumentDeCalatorie'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Serie si numar</td>
                                                    <td><?= $card['Contact']['SerieSiNumarDocument'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data emiterii</td>
                                                    <td><?= $card['Contact']['DataEmiteriiDocDeCalatorie'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data expirarii</td>
                                                    <td><?= $card['Contact']['DataExpirariiDocDeCalatorie'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Probleme medicale</td>
                                                    <td>???</td>
                                                </tr>
                                                <tr>
                                                    <td>Telefon folosit in tabara</td>
                                                    <td>???</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="uk-accordion-title" href="#">Date tabara</a>
                                        <div class="uk-accordion-content">
                                            <table class="uk-table uk-table-responsive uk-table-divider">
                                                <tbody>
                                                <tr>
                                                    <td>Nume oferta tabara</td>
                                                    <td><?= $card['Tabara']['NumeTabara2'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data incepere tabara</td>
                                                    <td><?= strtok($card['Tabara']['DataIncepereTabara2'], ' ') ;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data incheiere tabara</td>
                                                    <td><?= strtok($card['Tabara']['DataTerminareTabara'], ' ') ;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nume indrumator grup</td>
                                                    <td><?= $card['Tabara']['ProfesorProfesoriIndrumatori'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Exemplu program</td>
                                                    <td><?= $card['Tabara']['SampleProgramme'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Numar telefon detinator</td>
                                                    <td><?= $card['Contact']['Phone'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Student handbook</td>
                                                    <td><?= $card['Tabara']['StedentHandbook'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Ultima actualizare</td>
                                                    <td><?= $card['Tabara']['UpdatedAt'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Link facebook grup</td>
                                                    <td>???</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="uk-accordion-title" href="#">Financiar</a>
                                        <div class="uk-accordion-content">
                                            <table class="uk-table uk-table-responsive uk-table-divider">
                                                <tbody>
                                                <tr>
                                                    <td>Oferta tabara</td>
                                                    <td><?= $card['Tabara']['OfertaTransmisaSiAcceptata'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Contract atasat</td>
                                                    <td><a href="<?= $card['Detalii']['ContractAtasat'] ?>">Descarca</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Factura avans/td>
                                                    <td><a href="<?= $card['Detalii']['FacturiAtasate'] ?>">Descarca</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Factura rest plata</td>
                                                    <td><a href="<?= $card['Detalii']['IncarcaFactura3'] ?>">Descarca</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Factura bilet avion</td>
                                                    <td><a href="<?= $card['Detalii']['IncarcaFacturaAvion'] ?>">Descarca</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Data primei plati</td>
                                                    <td><?= $card['Detalii']['DataPrimeiPlati'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Incasare factura rest plata 1</td>
                                                    <td><?= $card['Detalii']['IncasareFacturaRestPlata1'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data incasare rest plata 1</td>
                                                    <td><?= $card['Detalii']['DataFacturaRestPlata1'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Incasare factura rest plata 2</td>
                                                    <td><?= $card['Detalii']['IncasareFacturaRestPlata2'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data incasare rest plata 2/td>
                                                    <td><?= $card['Detalii']['DataFacturaRestPlata2'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sold final</td>
                                                    <td><?= $card['Detalii']['Int1694'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Reduceri acordate</td>
                                                    <td><?= $card['Detalii']['ReduceriAcordate'] ?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="uk-accordion-title" href="#">Transport</a>
                                        <div class="uk-accordion-content">
                                            <table class="uk-table uk-table-responsive uk-table-divider">
                                                <tbody>
                                                <tr>
                                                    <td>Avion Tur</td>
                                                    <td><?= $card['Tabara']['AeroportDecolare'].' -> '.$card['Tabara']['AeroportAterizare'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Avion Retur</td>
                                                    <td><?= $card['Tabara']['AeroportDecolare2'].' -> '.$card['Tabara']['AeroportDecolare3'] ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
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
