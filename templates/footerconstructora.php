</main>
<!-- place footer here -->
<div >
<!-- Footer -->
<footer class="custom-footer text-white pt-4 pb-4">
        <div class="container text-center text-md-left">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#">Inicio</a></li>
                        <li class="list-inline-item"><a href="#">Atras</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 footer-bottom style=background-color: #97c2e2;">
            &copy; 2024 Innovatech Manizales. Todos los derechos reservados.
        </div>
    </footer>
</div>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<style>

        .custom-footer {
            background-color: #0faedd; /* Azul cielo */
        }
        .custom-footer .list-inline-item a {
            color: white;
            text-decoration: none;
        }
        .custom-footer .list-inline-item a:hover {
            color: #ee7203;
        }
        .custom-footer .footer-bottom {
            background-color: #74b959; /* Verde */
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        
        main {
            flex: 1;
        }

        
        @media (max-width: 768px) {
            .card {
                flex: 1 1 calc(50% - 1rem); /* En pantallas medianas, cada tarjeta ocupa la mitad del contenedor */
            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 1 1 calc(100% - 1rem); /* En pantallas pequeñas, cada tarjeta ocupa el ancho completo del contenedor */
            }
        }
    </style>