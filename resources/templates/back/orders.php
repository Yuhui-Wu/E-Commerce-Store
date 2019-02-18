<div class="col-md-12">
<div class="row">
<h2>
   All Orders

</h2>
<h4 class= "bg-success"><?php display_message(); ?></h4>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>Id</th>
           <th>Amount</th>
           <th>Date</th>
           <th>Status</th>
           <th>Customer</th>
           <th>Salesperson</th>

      </tr>
    </thead>
    <tbody>
      <?php display_orders(); ?>
        </tr>
        

    </tbody>
</table>
</div>










