<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{ date('Y') }}</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/master/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/master/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/master/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/master/js/sb-admin-2.min.js')}}"></script>

<script>
    $(document).ready(function() {

        $("#openCart").on("click", function (e) {
            e.preventDefault();

            // buka modal dulu
            $("#cartModal").modal('show');

            // kosongkan konten
            $("#cart-items-body").html(`
                <tr><td colspan="4" class="text-center">Loading...</td></tr>
            `);

            // ambil data cart via AJAX
            $.ajax({
                url: "{{ route('cart.data') }}",
                type: "GET",
                success: function(response) {

                    let cart = response.cart;

                    if (!cart || cart.items.length === 0) {
                        $("#cart-items-body").html(`
                            <tr>
                                <td colspan="4" class="text-center">Keranjang Kosong</td>
                            </tr>
                        `);
                        return;
                    }

                    let rows = "";

                    cart.items.forEach(item => {
                        rows += `
                            <tr>
                                <td>${item.product.name}</td>
                                <td>Rp ${Number(item.price_at_time).toLocaleString()}</td>
                                <td>${item.quantity}</td>
                                <td>Rp ${(item.quantity * item.price_at_time).toLocaleString()}</td>
                            </tr>
                        `;
                    });

                    $("#cart-items-body").html(rows);
                }
            });
        });

    });
</script>


@yield('script-bottom')
