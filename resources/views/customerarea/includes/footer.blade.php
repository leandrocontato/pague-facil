<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-end">
                <div class="text">
                    <span>©</span> Pague Fácil
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.4/sweetalert2.min.js"
        integrity="sha512-GDiDlK2vvO6nYcNorLUit0DSRvcfd7Vc0VRg7e3PuZcsTwQrJQKp5hf8bCaad+BNoBq7YMH6QwWLPQO3Xln0og=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".btn-delete").on("click", function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            new Swal({
                icon: 'warning',
                title: 'Deseja realmente remover esse cartão?',
                text: "Não será possivel a recuperação do mesmo.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        $('#validade').mask('99/9999');
        $('#validade').on('blur',function(e){
            e.preventDefault;
            var compare = $(this).val();
            var regex = "\\d{2}/\\d{4}";
            var dt = compare.split('/');
            if(dt == null)
            {
                return;
            }
            
        var dtMonth = dt[0];
        var dtYear = dt[1];

        if(dtMonth < 1 || dtMonth > 12 && dtYear < new Date().getFullYear()){
            $('#card_expery_date_validate').removeClass('d-none').addClass('d-block');
            $('#card_expery_date_validate').html('Mês e Ano Inválido.')
        }
        else if(dtMonth < 1 || dtMonth > 12){
            $('#card_expery_date_validate').removeClass('d-none').addClass('d-block');
            $('#card_expery_date_validate').html('Mes Inválido.')
        }
        else if(dtYear < new Date().getFullYear()){
            $('#card_expery_date_validate').removeClass('d-none').addClass('d-block');
            $('#card_expery_date_validate').html('Ano Inválido.')
        }

        });
    </script>
</footer>