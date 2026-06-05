<style>
  .card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;
  }

  .card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
  }

  .card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
  }

  .card-box .inner {
    padding: 5px 10px 0 10px;
  }

  .card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
  }

  .card-box p {
    font-size: 15px;
  }

  .card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 92px;
    color: rgba(0, 0, 0, 0.15);
  }

  .card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
  }

  .card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
  }

  .bg-blue {
    background-color: #00c0ef !important;
  }

  .bg-green {
    background-color: #00a65a !important;
  }

  .bg-orange {
    background-color: #f39c12 !important;
  }

  .bg-red {
    background-color: #d9534f !important;
  }

  .bg-brown {
    background-color: brown !important;
  }

  .bg-orangered {
    background-color: orangered !important;
  }

  .bg-midnightblue {
    background-color: midnightblue !important;
  }

  .bg-darkcyan {
    background-color: darkcyan !important;
  }

  .bg-crimson {
    background-color: crimson !important;
  }

  .bg-gold {
    background-color: gold !important;
  }

  .bg-olive {
    background-color: olive !important;
  }
</style>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-blue">
          <div class="inner">
            <h3> Products </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-bag" aria-hidden="true"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/products/manage_products" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-green">
          <div class="inner">
            <h3> Sub Products </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-truck" aria-hidden="true"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/sub_products/manage_subproducts" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-brown">
          <div class="inner">
            <h3> Attributos </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-pencil-ruler"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/attributes/manage_attributes" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-orangered">
          <div class="inner">
            <h3> Asignar Atributos </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-gifts"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/assign_attributes" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-midnightblue">
          <div class="inner">
            <h3> Asignar Precios </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-comment-dollar"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/pricing/manage_price" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-darkcyan">
          <div class="inner">
            <h3> Cantidades </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-weight"></i>
          </div>
          <a href="<?php echo base_url() ?>admin/common/manage_quantities" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-crimson">
          <div class="inner">
            <h3> Tamanos </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-rocket"></i>
          </div>
          <a href="<?php echo base_url() ?>admin/common/manage_sizes" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-gold">
          <div class="inner">
            <h3> Sliders </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="far fa-images"></i>
          </div>
          <a href="<?php echo base_url() ?>admin/slider" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-olive">
          <div class="inner">
            <h3> Orders </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fas fa-cart-arrow-down"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/order" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-orange">
          <div class="inner">
            <h3> Users </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
          </div>
          <a href="<?php echo base_url() ?>admin/users" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6">
        <div class="card-box bg-red">
          <div class="inner">
            <h3> Messages </h3>
            <p> listing </p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/copyservice/list_contact_us" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    <!-- <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
      </div>
      <div class="card-body">
        <table id="datatablesSimple">
          <thead>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
          </tfoot>
          <tbody>
            <tr>
              <td>Tiger Nixon</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
              <td>2011/04/25</td>
              <td>$320,800</td>
            </tr>
            <tr>
              <td>Garrett Winters</td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>63</td>
              <td>2011/07/25</td>
              <td>$170,750</td>
            </tr>
            <tr>
              <td>Ashton Cox</td>
              <td>Junior Technical Author</td>
              <td>San Francisco</td>
              <td>66</td>
              <td>2009/01/12</td>
              <td>$86,000</td>
            </tr>
            <tr>
              <td>Cedric Kelly</td>
              <td>Senior Javascript Developer</td>
              <td>Edinburgh</td>
              <td>22</td>
              <td>2012/03/29</td>
              <td>$433,060</td>
            </tr>
            <tr>
              <td>Airi Satou</td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>33</td>
              <td>2008/11/28</td>
              <td>$162,700</td>
            </tr>
            <tr>
              <td>Brielle Williamson</td>
              <td>Integration Specialist</td>
              <td>New York</td>
              <td>61</td>
              <td>2012/12/02</td>
              <td>$372,000</td>
            </tr>
            <tr>
              <td>Herrod Chandler</td>
              <td>Sales Assistant</td>
              <td>San Francisco</td>
              <td>59</td>
              <td>2012/08/06</td>
              <td>$137,500</td>
            </tr>
            <tr>
              <td>Rhona Davidson</td>
              <td>Integration Specialist</td>
              <td>Tokyo</td>
              <td>55</td>
              <td>2010/10/14</td>
              <td>$327,900</td>
            </tr>
            <tr>
              <td>Colleen Hurst</td>
              <td>Javascript Developer</td>
              <td>San Francisco</td>
              <td>39</td>
              <td>2009/09/15</td>
              <td>$205,500</td>
            </tr>
            <tr>
              <td>Sonya Frost</td>
              <td>Software Engineer</td>
              <td>Edinburgh</td>
              <td>23</td>
              <td>2008/12/13</td>
              <td>$103,600</td>
            </tr>
            <tr>
              <td>Jena Gaines</td>
              <td>Office Manager</td>
              <td>London</td>
              <td>30</td>
              <td>2008/12/19</td>
              <td>$90,560</td>
            </tr>
            <tr>
              <td>Quinn Flynn</td>
              <td>Support Lead</td>
              <td>Edinburgh</td>
              <td>22</td>
              <td>2013/03/03</td>
              <td>$342,000</td>
            </tr>
            <tr>
              <td>Charde Marshall</td>
              <td>Regional Director</td>
              <td>San Francisco</td>
              <td>36</td>
              <td>2008/10/16</td>
              <td>$470,600</td>
            </tr>
            <tr>
              <td>Haley Kennedy</td>
              <td>Senior Marketing Designer</td>
              <td>London</td>
              <td>43</td>
              <td>2012/12/18</td>
              <td>$313,500</td>
            </tr>
            <tr>
              <td>Tatyana Fitzpatrick</td>
              <td>Regional Director</td>
              <td>London</td>
              <td>19</td>
              <td>2010/03/17</td>
              <td>$385,750</td>
            </tr>
            <tr>
              <td>Michael Silva</td>
              <td>Marketing Designer</td>
              <td>London</td>
              <td>66</td>
              <td>2012/11/27</td>
              <td>$198,500</td>
            </tr>
            <tr>
              <td>Paul Byrd</td>
              <td>Chief Financial Officer (CFO)</td>
              <td>New York</td>
              <td>64</td>
              <td>2010/06/09</td>
              <td>$725,000</td>
            </tr>
            <tr>
              <td>Gloria Little</td>
              <td>Systems Administrator</td>
              <td>New York</td>
              <td>59</td>
              <td>2009/04/10</td>
              <td>$237,500</td>
            </tr>
            <tr>
              <td>Bradley Greer</td>
              <td>Software Engineer</td>
              <td>London</td>
              <td>41</td>
              <td>2012/10/13</td>
              <td>$132,000</td>
            </tr>
            <tr>
              <td>Dai Rios</td>
              <td>Personnel Lead</td>
              <td>Edinburgh</td>
              <td>35</td>
              <td>2012/09/26</td>
              <td>$217,500</td>
            </tr>
            <tr>
              <td>Jenette Caldwell</td>
              <td>Development Lead</td>
              <td>New York</td>
              <td>30</td>
              <td>2011/09/03</td>
              <td>$345,000</td>
            </tr>
            <tr>
              <td>Yuri Berry</td>
              <td>Chief Marketing Officer (CMO)</td>
              <td>New York</td>
              <td>40</td>
              <td>2009/06/25</td>
              <td>$675,000</td>
            </tr>
            <tr>
              <td>Caesar Vance</td>
              <td>Pre-Sales Support</td>
              <td>New York</td>
              <td>21</td>
              <td>2011/12/12</td>
              <td>$106,450</td>
            </tr>
            <tr>
              <td>Doris Wilder</td>
              <td>Sales Assistant</td>
              <td>Sidney</td>
              <td>23</td>
              <td>2010/09/20</td>
              <td>$85,600</td>
            </tr>
            <tr>
              <td>Angelica Ramos</td>
              <td>Chief Executive Officer (CEO)</td>
              <td>London</td>
              <td>47</td>
              <td>2009/10/09</td>
              <td>$1,200,000</td>
            </tr>
            <tr>
              <td>Gavin Joyce</td>
              <td>Developer</td>
              <td>Edinburgh</td>
              <td>42</td>
              <td>2010/12/22</td>
              <td>$92,575</td>
            </tr>
            <tr>
              <td>Jennifer Chang</td>
              <td>Regional Director</td>
              <td>Singapore</td>
              <td>28</td>
              <td>2010/11/14</td>
              <td>$357,650</td>
            </tr>
            <tr>
              <td>Brenden Wagner</td>
              <td>Software Engineer</td>
              <td>San Francisco</td>
              <td>28</td>
              <td>2011/06/07</td>
              <td>$206,850</td>
            </tr>
            <tr>
              <td>Fiona Green</td>
              <td>Chief Operating Officer (COO)</td>
              <td>San Francisco</td>
              <td>48</td>
              <td>2010/03/11</td>
              <td>$850,000</td>
            </tr>
            <tr>
              <td>Shou Itou</td>
              <td>Regional Marketing</td>
              <td>Tokyo</td>
              <td>20</td>
              <td>2011/08/14</td>
              <td>$163,000</td>
            </tr>
            <tr>
              <td>Michelle House</td>
              <td>Integration Specialist</td>
              <td>Sidney</td>
              <td>37</td>
              <td>2011/06/02</td>
              <td>$95,400</td>
            </tr>
            <tr>
              <td>Suki Burks</td>
              <td>Developer</td>
              <td>London</td>
              <td>53</td>
              <td>2009/10/22</td>
              <td>$114,500</td>
            </tr>
            <tr>
              <td>Prescott Bartlett</td>
              <td>Technical Author</td>
              <td>London</td>
              <td>27</td>
              <td>2011/05/07</td>
              <td>$145,000</td>
            </tr>
            <tr>
              <td>Gavin Cortez</td>
              <td>Team Leader</td>
              <td>San Francisco</td>
              <td>22</td>
              <td>2008/10/26</td>
              <td>$235,500</td>
            </tr>
            <tr>
              <td>Martena Mccray</td>
              <td>Post-Sales support</td>
              <td>Edinburgh</td>
              <td>46</td>
              <td>2011/03/09</td>
              <td>$324,050</td>
            </tr>
            <tr>
              <td>Unity Butler</td>
              <td>Marketing Designer</td>
              <td>San Francisco</td>
              <td>47</td>
              <td>2009/12/09</td>
              <td>$85,675</td>
            </tr>
            <tr>
              <td>Howard Hatfield</td>
              <td>Office Manager</td>
              <td>San Francisco</td>
              <td>51</td>
              <td>2008/12/16</td>
              <td>$164,500</td>
            </tr>
            <tr>
              <td>Hope Fuentes</td>
              <td>Secretary</td>
              <td>San Francisco</td>
              <td>41</td>
              <td>2010/02/12</td>
              <td>$109,850</td>
            </tr>
            <tr>
              <td>Vivian Harrell</td>
              <td>Financial Controller</td>
              <td>San Francisco</td>
              <td>62</td>
              <td>2009/02/14</td>
              <td>$452,500</td>
            </tr>
            <tr>
              <td>Timothy Mooney</td>
              <td>Office Manager</td>
              <td>London</td>
              <td>37</td>
              <td>2008/12/11</td>
              <td>$136,200</td>
            </tr>
            <tr>
              <td>Jackson Bradshaw</td>
              <td>Director</td>
              <td>New York</td>
              <td>65</td>
              <td>2008/09/26</td>
              <td>$645,750</td>
            </tr>
            <tr>
              <td>Olivia Liang</td>
              <td>Support Engineer</td>
              <td>Singapore</td>
              <td>64</td>
              <td>2011/02/03</td>
              <td>$234,500</td>
            </tr>
            <tr>
              <td>Bruno Nash</td>
              <td>Software Engineer</td>
              <td>London</td>
              <td>38</td>
              <td>2011/05/03</td>
              <td>$163,500</td>
            </tr>
            <tr>
              <td>Sakura Yamamoto</td>
              <td>Support Engineer</td>
              <td>Tokyo</td>
              <td>37</td>
              <td>2009/08/19</td>
              <td>$139,575</td>
            </tr>
            <tr>
              <td>Thor Walton</td>
              <td>Developer</td>
              <td>New York</td>
              <td>61</td>
              <td>2013/08/11</td>
              <td>$98,540</td>
            </tr>
            <tr>
              <td>Finn Camacho</td>
              <td>Support Engineer</td>
              <td>San Francisco</td>
              <td>47</td>
              <td>2009/07/07</td>
              <td>$87,500</td>
            </tr>
            <tr>
              <td>Serge Baldwin</td>
              <td>Data Coordinator</td>
              <td>Singapore</td>
              <td>64</td>
              <td>2012/04/09</td>
              <td>$138,575</td>
            </tr>
            <tr>
              <td>Zenaida Frank</td>
              <td>Software Engineer</td>
              <td>New York</td>
              <td>63</td>
              <td>2010/01/04</td>
              <td>$125,250</td>
            </tr>
            <tr>
              <td>Zorita Serrano</td>
              <td>Software Engineer</td>
              <td>San Francisco</td>
              <td>56</td>
              <td>2012/06/01</td>
              <td>$115,000</td>
            </tr>
            <tr>
              <td>Jennifer Acosta</td>
              <td>Junior Javascript Developer</td>
              <td>Edinburgh</td>
              <td>43</td>
              <td>2013/02/01</td>
              <td>$75,650</td>
            </tr>
            <tr>
              <td>Cara Stevens</td>
              <td>Sales Assistant</td>
              <td>New York</td>
              <td>46</td>
              <td>2011/12/06</td>
              <td>$145,600</td>
            </tr>
            <tr>
              <td>Hermione Butler</td>
              <td>Regional Director</td>
              <td>London</td>
              <td>47</td>
              <td>2011/03/21</td>
              <td>$356,250</td>
            </tr>
            <tr>
              <td>Lael Greer</td>
              <td>Systems Administrator</td>
              <td>London</td>
              <td>21</td>
              <td>2009/02/27</td>
              <td>$103,500</td>
            </tr>
            <tr>
              <td>Jonas Alexander</td>
              <td>Developer</td>
              <td>San Francisco</td>
              <td>30</td>
              <td>2010/07/14</td>
              <td>$86,500</td>
            </tr>
            <tr>
              <td>Shad Decker</td>
              <td>Regional Director</td>
              <td>Edinburgh</td>
              <td>51</td>
              <td>2008/11/13</td>
              <td>$183,000</td>
            </tr>
            <tr>
              <td>Michael Bruce</td>
              <td>Javascript Developer</td>
              <td>Singapore</td>
              <td>29</td>
              <td>2011/06/27</td>
              <td>$183,000</td>
            </tr>
            <tr>
              <td>Donna Snider</td>
              <td>Customer Support</td>
              <td>New York</td>
              <td>27</td>
              <td>2011/01/25</td>
              <td>$112,000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>
</main>