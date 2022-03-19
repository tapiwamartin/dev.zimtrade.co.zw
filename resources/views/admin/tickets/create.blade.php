@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Create an Inquiry</h2>
            </div>
            <div class="card-body">
                <form action="{{route('ticket.store')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                <p>Fill in all necessary to create an inquiry.</p>
                <h6 for="first-name-icon" id="ticket-subject">Inquiry Subject</h6>
                <div class="form-group has-icon-left mb-3">
                <div class="position-relative">
                    <input type="text" class="form-control"
                           placeholder="Enter Subject"  name="subject" id="subject" required="">
                    <div class="form-control-icon">
                        <i class="bi bi-book-half"></i>
                    </div>
                </div>
                </div>
                   <h6 id="ticket-describe">Describe Your Inquiry</h6>
                <div id="snow" class="mb-3">
                    <textarea name="description" ></textarea>
                </div>
                <h6 for="first-name-icon" id="ticket-attachments">Attach File(s)</h6>
                <input type="file" class="mb-2" id="fileUpload" onchange="return fileValidation()" >
                <div class="col-md-6 mb-4">
                    <h6>What sector you want to inquire about? </h6>

                    <div class="form-group" id="ticket-sector">
                        <select class="choices form-select" name="sectorId" id="sectorId">
                            @forelse($sectors as $sector)
                            <option value="{{$sector->id}}">{{$sector->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                </div>
                <button id="create-ticket" class="btn btn-outline-primary float-lg-end float-md-end float-sm-end" onclick="submitTicket()">Create Inquiry</button>
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
    document.getElementById('create-ticket').innerText = 'Inquiry is being Created Please Wait.......'
    document.getElementById('create-ticket').disable = true
    request.onreadystatechange = function () {
        if (request.readyState == XMLHttpRequest.DONE) {
            var jsonResponse = JSON.parse(request.responseText)
           //console.log(jsonResponse.data)

        }
    request.onload = function () {
    window.location = '/ticket';
    //document.getElementById('create-ticket').innerText = 'Create Ticket'
    }
    }
    }
    </script>

@endsection
