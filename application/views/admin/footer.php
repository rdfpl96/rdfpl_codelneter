
    </div>
     <!-- Jquery Core Js -->



      <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>include/assets/bundles/jquery.js"></script>
    
    
    <script src="<?php echo base_url();?>include/assets/main.js"></script>
    <script src="<?php echo base_url();?>include/assets/bundles/libscripts.bundle.js"></script>
    <script src="<?php echo base_url();?>include/assets/bundles/apexcharts.bundle.js"></script>
    <script src="<?php echo base_url();?>include/assets/bundles/dataTables.bundle.js"></script><script src="<?php echo base_url();?>include/assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>  
    <script src="<?php echo base_url();?>include/assets/js/template.js"></script>
    <script src="<?php echo base_url();?>include/assets/js/page/index.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?
    key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&amp;callback=myMap"></script>  


    <script src="<?php echo base_url();?>include/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>include/assets/js/JsLocalSearch.js"></script>

    <!-- <script src="<?php echo base_url();?>include/assets/js/editor.js"></script> -->
   

<script src="<?php echo base_url();?>include/assets/ajax.js"></script>


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo base_url();?>include/assets/js/bootstrap-datepicker.min.js"></script>

   <script src="<?php echo base_url();?>include/assets/js/select2.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
<?php
   $exportUrl=explode('/', $_SERVER['REQUEST_URI']);
   $getFilename=(in_array($fileName,$exportUrl)) ? $fileName:'';
   echo $this->my_libraries->summernoteLibraryJS($getFilename,$fileName);
?>

    <script>

        $(document).ready(function () {
          $('#product_id').chosen();
        });

        $(document).ready(function () {
          $('#product_variant').chosen();
        });
        

         $(".customerClass").select2({
          placeholder: "-Select-",
        
          width: '100%',
          allowClear: true
        });

          $(".productClass").select2({
          placeholder: "-Select-",
        
          width: '100%',
          allowClear: true
        });

        $(".stateClass").select2({
          placeholder: "-Select-",
          width: '100%',
          allowClear: true
        });


          


        // $(".proNameClass").select2({
        //   placeholder: "-Select-",
        
        //   width: '100%',
        //   allowClear: true
        // });
         
        //   $("#hsn-code").select2({
        //   placeholder: "-Select-",
        //   allowClear: true
        // });

        $('#myDataTable')
        .addClass( 'nowrap')
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });


    $(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
         }
      });

    function updateOrder(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondrop",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }

     $(".row_position_subcate").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_subcate>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateSubcate(selectedData);
         }
      });


    function updateSubcate(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondrop_subcate",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


    
      $(".row_position_childcate").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_childcate>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updatechildcate(selectedData);
         }
      });

       function updatechildcate(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondrop_childcate",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }



    $(".row_position_period").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_period>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateshelflife(selectedData);
         }
      });

     function updateshelflife(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondrop_shelfLife",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


    $(".row_position_blogs").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_blogs>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            update_blog(selectedData);
         }
      });

     function update_blog(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondrop_blogs",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


      $(".order_status_css").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.order_status_css>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrderStatus(selectedData);
         }
      });

    function updateOrderStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondropORderStatus",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }



    $(".row_position_sidebar").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_sidebar>tr').each(function() {
              
              if($(this).attr("id")!=undefined){
                // console.log($(this).attr("id"));
                selectedData.push($(this).attr("id"));
               }
            });
            updateSidebar(selectedData);
         }
      });

    function updateSidebar(data) {
        $.ajax({
            url:base_url+"ajax_function/getDrogondropSidebar",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }



     $(".row_position_tag").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_tag>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateGalleryTagStatus(selectedData);
         }
      });

    function updateGalleryTagStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/getGalleryTagStatus",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


     $(".row_position_team").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_team>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateTeamStatus(selectedData);
         }
      });

    function updateTeamStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/getTeamStatus",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


    $(".row_position_testi").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_testi>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateTestimonialStatus(selectedData);
         }
      });

    function updateTestimonialStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/getTestimonial",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }

      $(".row_position_kyf").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_kyf>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updatekyfStatus(selectedData);
         }
      });

    function updatekyfStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/getKyfPostion",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


     $(".row_position_banner").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_banner>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateBannerStatus(selectedData);
         }
      });

    function updateBannerStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/getBannerPostion",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


  $(".row_position_hometesti").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position_hometesti>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updatehomeTestimonialStatus(selectedData);
         }
      });

    function updatehomeTestimonialStatus(data) {
        $.ajax({
            url:base_url+"ajax_function/gethomeTestimonial",
            type:'POST',
            data:{position:data},
            success:function(){
                // alert('your change successfully saved');
            }
        })
    }


    



    // ========================

            $(document).ready(function(){

             $('#gsearchsimple').keyup(function(){
              var query = $('#gsearchsimple').val();
              $('#detail').html('');
              $('.list-group').css('display', 'block');
              
               $.ajax({
                    url:'<?php echo base_url('search-hsn-dropdown');?>',
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                     $('.list-group').html(data);
                    }
               })
              

              if(query.length == 0){
               $('.list-group').css('display', 'none');
              }
              
             });

             $('#localSearchSimple').jsLocalSearch({
              action:"Show",
              html_search:true,
              mark_text:"marktext"
             });

             $(document).on('click', '.gsearch', function(){
              var inputValue = $(this).text();
              var splitValue=inputValue.split(' -> ');
              $('#gsearchsimple').val(splitValue[0]);
              $('.list-group').css('display', 'none');
              
             });
            });

            $(document).click(function (e) {
                $('.list-group').css('display', 'none');
                // $('#gsearchsimple').val('');
            });

            // $( "#date-year" ).datepicker({dateFormat: 'yy'});
             $("#yearPicker").datepicker({
                 format: "yyyy",
                 viewMode: "years", 
                 minViewMode: "years",
                 autoclose:true
              });   

           
</script>


 <script type="text/javascript">
     // Addmission by Division
    $(document).ready(function() {

      var orderData='<?php echo $this->my_libraries->sellingProductGraphBar();?>';
      // console.log(eval(orderData));
        var options = {
            series:eval(orderData),
        
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: true
                }
            },
            colors: ['var(--chart-color1)','var(--chart-color2)','var(--chart-color3)','var(--chart-color4)','var(--chart-color7)','var(--chart-color6)'],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            xaxis: {
                categories: ['Jan','Feb','March','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
            },
            legend: {
                position: 'top', // top, bottom
                horizontalAlign: 'right', // left, right
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1
            }
        };

        var chart = new ApexCharts(document.querySelector("#topselling"), options);
        chart.render();
    });


   // basic-column
$(document).ready(function() {
    var options = {
        chart: {
            height: 300,
            type: 'bar',
        },
        colors: ['var(--chart-color1)', 'var(--chart-color2)','var(--chart-color3)'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'  
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, ],
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: ''
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#apex-basic-column"),
        options
    );

    chart.render();
});

// ========basic chat end==========

 // basic-column
$(document).ready(function() {
    var options = {
        chart: {
            height: 300,
            type: 'bar',
        },
        colors: ['var(--chart-color5)'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'  
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, ],
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: ''
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#apex-basic-column2"),
        options
    );

    chart.render();
});

// ========basic chat end==========

 // basic-column
$(document).ready(function() {
    var options = {
        chart: {
            height: 300,
            type: 'bar',
        },
        colors: ['var(--chart-color2)'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'  
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, ],
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: ''
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#apex-basic-column3"),
        options
    );

    chart.render();
});

// ========basic chat end==========

 // basic-column
$(document).ready(function() {
    var options = {
        chart: {
            height: 300,
            type: 'bar',
        },
        colors: ['var(--chart-color7)'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'  
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, ],
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: ''
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#apex-basic-column4"),
        options
    );

    chart.render();
});

// ========basic chat end==========



    $(document).ready(function() {

      var amountData='<?php echo $this->my_libraries->getEarningGgraphBar();?>';
        var options = {
            series: [{
                name: 'Earn',
                data: eval(amountData)
            }],
            chart: {
                height: 400,
                type: 'bar',
                toolbar: {
                    show: false,
                },
            },
            colors: ['var(--chart-color3)'],
            plotOptions: {
                bar: {
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return "₹"+val ;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ['var(--color-500)'],
                }
            },
            
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr","May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "₹";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-expense"), options);
        chart.render();
    });
 </script>





     <style type="text/css">
    .modal-header {display: inherit !important;}
    .table_cart_popup tr th {padding: 0px !important;font-weight: 500;}
    .table_cart_popup tr td {padding: 4px !important;}
    .text-maroon{color: #689F39;}

    .list-group {
      position: absolute !important;
      display: none;
   }
    </style>

  
</body>
</html>