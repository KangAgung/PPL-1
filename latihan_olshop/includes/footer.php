    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; <?php echo date('Y'); ?> </p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/fancybox/jquery.fancybox.min.js"></script>
  <script>
    $(document).ready(function() {
      if ($(document).height() <= 657) {
        $("footer").addClass("fixed-bottom");
      }
    });
  </script>
</body>

</html>