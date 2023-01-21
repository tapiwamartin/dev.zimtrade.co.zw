@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="card shadow col-md-6 offset-3 mb-4">
            <div class="card-header">
                <h2 class="card-title">Create a Deposit</h2>
            </div>
            <div class="card-body">
                <form action="{{route('deposit.store')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                <p>Fill in all necessary to create a deposit.</p>
                <h6 for="first-name-icon" id="ticket-subject">Amount</h6>
                <div class="form-group has-icon-left mb-3">
                <div class="position-relative">
                    <input type="number" class="form-control"
                           placeholder="Enter Amount"  name="amount" id="amount" required="">
                    <div class="form-control-icon">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
                </div>
                    <h6 for="first-name-icon" id="ticket-subject">Date</h6>
                    <div class="form-group has-icon-left mb-3">
                        <div class="position-relative">
                            <input type="date" class="form-control"
                                   placeholder="Enter Date"  name="transactionDate" id="transactionDate" required="">
                            <div class="form-control-icon">
                                <i class="bi bi-receipt"></i>
                            </div>
                        </div>
                    </div>


                    <h6>Region </h6>

                    <div class="col-md-12 mb-6 form-group" id="ticket-sector">
                        <select class="choices form-select" name="regionId" id="regionId">
                            @forelse($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <h6>Currency </h6>

                    <div class="col-md-12 mb-6 form-group" id="ticket-sector">
                        <select class="choices form-select" name="currencyId" id="currencyId">
                            @forelse($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <h6>Narration </h6>

                    <div class="col-md-12 mb-6 form-group" id="ticket-sector">
                        <select class="choices form-select" name="narrationId" id="narrationId">
                            @forelse($narrations as $narration)
                                <option value="{{$narration->id}}">{{$narration->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                <button id="create-ticket" class="btn btn-outline-primary float-lg-end float-md-end float-sm-end" >Create</button>
                </form>
            </div>

        </div>
    </section>
    <script>
    function fileValidation() {
    var fileInput = document.getElementById('fileUpload');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.doc|\.docx|\.jpeg|\.pdf|\.rtf|\.png|\.jpg)$/i;
        var fsize = fileInput.files[0].size;
        var file = Math.round((fsize / 1024));
            if (!allowedExtensions.exec(filePath)) {
                    alert('Invalid file type');
                    fileInput.value = '';
                    return false;
            }
            else if(file >= 4096)
            {
                alert('Invalid file size. Your file should be less than 4MB. Your file size is '+ Math.floor(file/1024) +'MB' );
                fileInput.value = '';
                return false
            }


            }
    function submitTicket() {
    event.preventDefault();
    let formData = new FormData();
    var container = document.getElementById('snow');
    var editor = new Quill(container);
    var getInput = editor.root.innerHTML;
    if(editor.getLength() === 1  )
        {
        alert('Never miss giving description! Fill in the description field')
        return false
        }
    else if(document.getElementById('subject').value === '')
        {

            alert('Fill in the subject field')
            return false
        }
    formData.append("subject", document.getElementById('subject').value);
    formData.append("description", getInput);
    var theFile = document.getElementById('fileUpload').files[0]
    formData.append("fileUpload", theFile);
    formData.append("sectorId", document.getElementById('sectorId').value);
    var request = new XMLHttpRequest();
    request.open("POST", "/ticket");
    request.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}')
    request.send(formData);
    document.getElementById('create-ticket').innerText = 'Deposit is being Created Please Wait.......'
    document.getElementById('create-ticket').disable = true
    request.onreadystatechange = function () {
        if (request.readyState == XMLHttpRequest.DONE) {
            var jsonResponse = JSON.parse(request.responseText)
           //console.log(jsonResponse.data)

        }
    request.onload = function () {
    window.location = '/ticket';
    //document.getElementById('create-ticket').innerText = 'Create Deposit'
    }
    }
    }
    </script>

@endsection
