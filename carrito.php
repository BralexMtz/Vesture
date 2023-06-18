    <?php require_once "config/conexion.php";
require_once "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link href="assets/css/estilos.css" rel="stylesheet" />
    <link href="assets/css/style_cart.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style_modal_admin.css">

</head>

<body>
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul>
                <li><span class="fw-bolder">Carrito</span></li>
                <li style="float:right">
                    <!-- <a class="active" href="#about">About</a> -->
                    <a class="active navbar-brand" href="./">TSC2</a>
                </li>
            </ul>
            <!-- <div class="container-fluid">
                <a class="navbar-brand" href="./">TSC2</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div> -->
        </nav>
    </div>
    <!-- Header-->
    <header class="bg-dark" style="padding-top: 5rem">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                
                <h2 class="lead fw-normal text-white-50 mb-0" style="text-align: center;">Tus Productos</h2>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row" style="justify-content: center;">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table fl-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <br>
            <div class="row" style="justify-content: center;">
                <div class="col-md-12">
                    <h4  style="text-align: center;" >Total a Pagar: $<span id="total_pagar">0.00</span> MXN</h4>
                </div>
                <div class="col-md-12" style="display:flex;justify-content: center;">
                <a href="#modal-compra"><button  id="btn-modal-compra"  class="button button-green" type="button" >Comprar</button></a>
                <button class="button button-red" type="button" id="btnVaciar" >Vaciar Carrito</button>
                    
                </div>

            </div>
        </div>
    </section>
    <div id="modal-compra" class="modal">
        <div class="modal__content">
            <div class="modal-header bg-gradient-primary text-white">
                <h2 class="modal-title" id="title">Comprar Carrito</h2>
            </div>
            <div class="modal-body">
                <!-- <form id="client_data_form" method="POST" enctype="multipart/form-data"> -->
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form__group field">
                                    <input type="text" class="form__field" id="nombre" name="nombre" placeholder="nombre" required />
                                    <label for="nombre" class="form__label">Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form__group field">
                                    <input type="text" class="form__field" id="apellido_paterno" name="apellido_paterno" placeholder="apellido_paterno" />
                                    <label for="apellido_paterno" class="form__label">Apellido paterno</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form__group field">
                                    <input type="text" class="form__field" id="apellido_materno" name="apellido_materno" placeholder="apellido_materno" />
                                    <label for="apellido_materno" class="form__label">Apellido Materno</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form__group field">
                                    <input type="text" class="form__field" id="correo" name="correo" placeholder="correo" required />
                                    <label for="correo" class="form__label">correo electronico</label>
                                </div>
                            </div>
                    </div>
                    <div class="row d-flex end">
                        <button id="btn-comprar" class="button button-blue" onclick="comprarCarrito(this)">comprar</button>
                    </div>
                <!-- </form> -->
            </div>
            <a href="#" class="modal__close">&times;</a>
        </div>
    </div>
    <!-- Footer
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; PTSIC2 2023</p>
        </div>
    </footer> -->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&locale=<?php echo LOCALE; ?>"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        mostrarCarrito();

        function mostrarCarrito() {
            if (localStorage.getItem("productos") != null) {
                let array = JSON.parse(localStorage.getItem('productos'));
                if (array.length > 0) {
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        async: true,
                        data: {
                            action: 'buscar',
                            data: array
                        },
                        success: function(response) {
                            console.log(response);
                            const res = JSON.parse(response);
                            let html = '';
                            res.datos.forEach(element => {
                                html += `
                            <tr>
                                <td>${element.id}</td>
                                <td>${element.nombre}</td>
                                <td>${element.precio}</td>
                                <td>1</td>
                                <td>${element.precio}</td>
                            </tr>
                            `;
                            });
                            $('#tblCarrito').html(html);
                            $('#total_pagar').text(res.total);
                            paypal.Buttons({
                                style: {
                                    color: 'blue',
                                    shape: 'pill',
                                    label: 'pay'
                                },
                                createOrder: function(data, actions) {
                                    // This function sets up the details of the transaction, including the amount and line item details.
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: res.total
                                            }
                                        }]
                                    });
                                },
                                onApprove: function(data, actions) {
                                    // This function captures the funds from the transaction.
                                    return actions.order.capture().then(function(details) {
                                        // This function shows a transaction success message to your buyer.
                                        alert('Transaction completed by ' + details.payer.name.given_name);
                                    });
                                }
                            });
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        }
        function comprarCarrito(){
            // event.preventDefault();
            // event.stopPropagation();
            var formData = new FormData();
            let array_form_client=Array.from(document.querySelectorAll("#modal-compra input"));
            array_form_client.forEach(e_inp=>{
                formData.append(e_inp.name, e_inp.value);    
            });
            
            var url = 'ajax.php';
            let productos = localStorage.getItem('productos');
            let nombre = 
            formData.append('action', 'comprar');
            formData.append('productos', productos);

            fetch(url, {
                method: 'POST', // or 'PUT'
                body: formData, // data can be `string` or {object}!
            })
            .catch(error => console.error('Error:', error))
            .then(response => {
                if(response.ok) {
                    localStorage.removeItem("productos");
                    $('#tblCarrito').html('');
                    document.getElementById('tblCarrito').innerHTML='';
                    $('#total_pagar').text('0.00');
                    document.getElementById('total_pagar').innerText='0.00';
                    window.location.hash='#';
                    document.querySelector('#btn-modal-compra').disabled = true;
                }
            });
        }


    </script>
</body>

</html>