<?php
    require 'function.php';
    require 'cek.php';   

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-primary bg-primary">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!" style="color: white;"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-white" href="index.php">WAREHOUSE MANAGEMENT SYSTEM</a>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion" id="sidenavAccordion" style="background: #0d6efd;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading text-white">Menu</div>
                            <a class="nav-link text-white" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link text-white" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Inventory
                            </a>
                            <a class="nav-link text-white" href="incoming.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Incoming
                            </a>
                            <a class="nav-link text-white" href="outgoing.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Outgoing
                            </a>
                            <a class="nav-link text-white" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Logout
                            </a>
                            
                            <div class="sb-sidenav-menu-heading text-white">Addons</div>
                            <a class="nav-link text-white" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link text-white" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Administrator
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Inventory</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Alert-->

                        <?php
                            $ambildatastock = mysqli_query($conn, "SELECT * FROM `stock` where stock < 1");
                            while($fetch=mysqli_fetch_array($ambildatastock)){
                                $barang = $fetch['namabarang'];                            
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show " role="alert">
                          <strong >Alert!</strong> Stock Material Of <?=$barang;?> Empty, <a href="" class="text-danger">Please Create PR.</a>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php
                            }
                        ?>

                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Add New Material 
                            </button>
                        <!--Table Output-->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Inventory Stock Data Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Material Name</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM `stock`");
                                            $i = 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $namabarang = $data['namabarang'];
                                            $deskripsi = $data['deskripsi'];
                                            $stock = $data['stock'];
                                            $idb = $data['idbarang'];
                                        
                                    ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$deskripsi;?></td>
                                            <td><?=$stock;?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#edit<?=$idb;?>">
                                                  Edit
                                                </button>
                                                <input type="hidden" name="idbarangyangmaudihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-sm btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#delete<?=$idb;?>">
                                                  Delete
                                                </button>
                                            </td>                                            
                                        </tr>

                                         <!-- Modal Edit-->
                                        <div class="modal fade" id="edit<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Material</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>

                                              <form method="POST">
                                              <div class="modal-body">
                                                <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="deskripsi" value="<?=$deskripsi;?>" class="form-control" required>
                                                <br>
                                                <input type="hidden" value="<?=$idb;?>" name="idb">
                                                
                                                <button class="btn btn-sm btn-primary" type="submit" name="updatebarang">Submit</button>
                                              </div>
                                            </form>

                                            </div>
                                          </div>
                                        </div>

                                         <!-- Modal Delete-->
                                         <div class="modal fade" id="delete<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Material</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>

                                              <form method="POST">
                                              <div class="modal-body">
                                                <p>Are You Sure Want Delete <?=$namabarang;?>?</p>
                                                <input type="hidden" value="<?=$idb;?>" name="idb">
                                                <button class="btn btn-sm btn-danger" type="submit" name="hapusbarang">Delete</button>
                                              </div>
                                            </form>

                                            </div>
                                          </div>
                                        </div>
                                    <?php
                                        };
                                    ?>
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; alfimaulana 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Material</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form method="POST">
              <div class="modal-body">
                <input type="text" name="namabarang" placeholder="Material Name" class="form-control" required>
                <br>
                <input type="text" name="deskripsi" placeholder="Description" class="form-control" required>
                <br>
                <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                <br>
                <button class="btn btn-sm btn-primary" type="submit" name="addnewbarang">Submit</button>
              </div>
            </form>

            </div>
          </div>
        </div>
</html>
