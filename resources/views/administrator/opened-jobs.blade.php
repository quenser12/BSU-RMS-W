<x-main>
    <x-flash-message/>
    <div class="home-content mb-4">
        <div class="text">Manage Jobs</div>
        <p><a class="text-decoration-none text-reset">Manage Jobs</a> / <b>Opened Jobs</b> </p>
    </div>
    

<div class="row">
    <div class="container" style="height: 100%px; overflow-y: auto;">
      <div class="card">
        <div class="card-body">

        
      <div class="row mt-2">
        <div class="col-md-6">
            <label for="" class="hidden"></label>
        </div>
        <div class="col-md-6">
            <input type="text" name="openedJobsSearch" class="form-control" id="openedJobsSearch" placeholder="Search Table..">
       </div>
      </div>
      <table class="table text-center" id="openedJobs">
      <thead>
        <tr >
          <th class="text-center" style="font-weight: bold;">Opened Job Positions</th>
          <th class="text-center" style="font-weight: bold;">Item Number</th>
          <th class="text-center" style="font-weight: bold;">Date of Job Opened</th>
          <th class="text-center" style="font-weight: bold;">Closing Date</th>
          <th class="text-center" style="font-weight: bold;">Created at</th>
          <th style="font-weight: bold;">Action</th>
        </tr>
      </thead>
      <tbody id="openedJobsSearchTable">
        @if($jobs)
        @foreach ($jobs as $job)
          @if($job['to_close']==0)
            <tr>
                <td>{{$job['job_title']}}</td>
                <td>{{$job['item_number']}}</td>
                <td>{{$job['opening_date']}}</td>
                <td>{{$job['closing_date']}}</td>
                <td>{{$job['created_at']}}</td>
                <td>
                  <form action="/admin/job-management/opened-jobs/close/{{$job->job_id}}" method="post">
                    @csrf
                    <a href="/admin/job-management/edit-job/{{$job->job_id}}" class="btn btn-info">Edit</a>
                    <button type="submit" class="btn btn-danger closeJobBtn">Close</button>
                  </form>
                </td>    
            </tr>
          @endif
        @endforeach
        @endif
      </tbody>
      </table>
    </div>
  </div>
    </div>
  </div>

</x-main>

<script>
  $(".closeJobBtn").on("click", function(e) {
e.preventDefault(); 
Swal.fire({
    title: "Confirm Action",
    text:"Are you sure you want to close job?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Close Job!'
}).then(function(isConfirm) {
  if(isConfirm.value){
    $(e.target).closest('form').submit();
  }
  
    })
});
</script>

<script>
  $("document").ready(function () {

    // $('#openedJobs').DataTable({
    //   searching:false,
    //     pagingType: 'full_numbers',
    // });

    $("#openedJobsSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#openedJobsSearchTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    $("#openedJobs").dataTable({
      searching: false,
      pagingType: 'full_numbers',
      dom: 'lBfrtip<"actions">',
        buttons: [
                    // {
                    //   extend:'copy',
                    //   className: 'btn ',
                    //   text: window.copyButtonTrans,
                    //     exportOptions: {
                    //         columns: ['0','1','2','3','4','5','6'],
                    //     }
                    // },
                    {
                      extend:'excel',
                      className: 'btn ',
                      text: window.excelButtonTrans,
                        exportOptions: {
                            columns: ['0','1','2','3','4'],
                        }
                    },
                    // {
                    //   extend:'csv',
                    //   className: 'btn ',
                    //   text: window.csvButtonTrans,
                    //     exportOptions: {
                    //         columns: ['0','1','2','3','4','5','6'],
                    //     }
                    // },
                    // {
                    //   extend:'pdf',
                    //   className: 'btn ',
                    //   text: window.pdfButtonTrans,
                    //     exportOptions: {
                    //         columns: ['0','1','2','3','4','5','6'],
                    //     }
                    // },
                    // {
                    //   extend:'print',
                    //   className: 'btn ',
                    //   text: window.printButtonTrans,
                    //     exportOptions: {
                    //         columns: ['0','1','2','3','4','5','6'],
                    //     }
                    // },
                    
                ],

    });
    
  });
</script>