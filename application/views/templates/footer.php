 <footer class="main-footer">
     <div class="footer-left">
         Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
     </div>
     <div class="footer-right">
         2.3.0
     </div>
 </footer>
 </div>
 </div>

 <!-- General JS Scripts -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
 <script src="<?= base_url() ?>assets/js/stisla.js"></script>

 <!-- JS Libraies -->
 <script src="<?= base_url('assets/libs/izitoast/js/iziToast.min.js') ?>"></script>
 <!-- Template JS File -->
 <script src="<?= base_url() ?>assets/js/scripts.js"></script>
 <script src="<?= base_url() ?>assets/js/custom.js"></script>
 <style>
    .lds-roller {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    }
    .lds-roller div {
    animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    transform-origin: 40px 40px;
    }
    .lds-roller div:after {
    content: " ";
    display: block;
    position: absolute;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #000;
    margin: -4px 0 0 -4px;
    }
    .lds-roller div:nth-child(1) {
    animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
    top: 63px;
    left: 63px;
    }
    .lds-roller div:nth-child(2) {
    animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
    top: 68px;
    left: 56px;
    }
    .lds-roller div:nth-child(3) {
    animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
    top: 71px;
    left: 48px;
    }
    .lds-roller div:nth-child(4) {
    animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
    top: 72px;
    left: 40px;
    }
    .lds-roller div:nth-child(5) {
    animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
    top: 71px;
    left: 32px;
    }
    .lds-roller div:nth-child(6) {
    animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
    top: 68px;
    left: 24px;
    }
    .lds-roller div:nth-child(7) {
    animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
    top: 63px;
    left: 17px;
    }
    .lds-roller div:nth-child(8) {
    animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
    top: 56px;
    left: 12px;
    }
    @keyframes lds-roller {
    0% {
    transform: rotate(0deg);
    }
    100% {
    transform: rotate(360deg);
    }
    }
    </style>
 <script>
     $(document).ready(function() {

         var limit = 7;
         var start = 0;
         var action = 'inactive';

         function lazzy_loader(limit) {
             var output = '';
             for (var count = 0; count < limit; count++) {
                 output += '<div class="post_data">';
                 output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
                 output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
                 output += '</div>';
             }
             $('#load_data_message').html(output);
         }

         lazzy_loader(limit);

         function load_data(limit, start) {
             $.ajax({
                 url: "<?php echo base_url('Scroll_pagination/info_stock_barang'); ?>",
                 method: "POST",
                 data: {
                     limit: limit,
                     start: start
                 },
                 cache: false,
                 success: function(data) {
                     if (data == '') {
                         $('#load_data_message').html('<h3>No More Result Found</h3>');
                         action = 'active';
                     } else {
                         $('#load_data').append(data);
                         $('#load_data_message').html("");
                         action = 'inactive';
                     }
                 }
             })
         }

         if (action == 'inactive') {
             action = 'active';
             load_data(limit, start);
         }

         $('#someScrollingDiv').scroll(function() {
             if ($(this).scrollTop() + $(this).innerHeight() > $("#someScrollingDiv").innerHeight() && action == 'inactive') {
                 lazzy_loader(limit);
                 action = 'active';
                 start = start + limit;
                 setTimeout(function() {
                     load_data(limit, start);
                 }, 1000);
             }
         });

     });
 </script>
 <!-- Page Specific JS File -->
 </body>

 </html>