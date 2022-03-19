@extends('layouts.master')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Create a Newsletter</h2>
            </div>
            <div class="card-body">
                <form action="{{route('newsletter.store')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                <p>Fill in all necessary for you newsletter, feel free to attach documents.</p>
                <h6 for="first-name-icon">NewsLetter Subject</h6>
                <div class="form-group has-icon-left mb-3">
                <div class="position-relative">
                    <input type="text" class="form-control"
                           placeholder="Enter Subject"  name="subject" id="subject" required="">
                    <div class="form-control-icon">
                        <i class="bi bi-book-half"></i>
                    </div>
                </div>
                </div>
                   <h6>Give Full Detail of your NewsLetter</h6>
                <div id="full" class="mb-3">
                    <textarea name="description" ></textarea>
                </div>
                <h6 for="first-name-icon">Attach File(s)</h6>
                <input type="file" class="mb-2" id="fileUpload" onchange="return fileValidation()" >

                <button id="create-ticket" class="btn btn-outline-primary float-lg-end float-md-end float-sm-end" onclick="submitTicket()">Create Newsletter</button>
                </form>
            </div>

        </div>
    </section>
    <script>

        function fileValidation() {
            var fileInput =
                document.getElementById('fileUpload');

            var filePath = fileInput.value;

            // Allowing file type
           var allowedExtensions = /(\.doc|\.docx|\.jpeg|\.pdf|\.rtf|\.png|\.jpg)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            }
        }



        function submitTicket() {


            event.preventDefault();
            let formData = new FormData();
            var container = document.getElementById('full');
            var editor = new Quill(container);
            var getInput = editor.getContents();

            if(getInput.ops[0].insert ==='' || document.getElementById('subject').value === '' )
            {
                alert('Fill in all required fields')


                return false
            }

            formData.append("subject", document.getElementById('subject').value);
            formData.append("description", getInput.ops[0].insert);

            var theFile = document.getElementById('fileUpload').files[0]

            formData.append("fileUpload", theFile);



            var request = new XMLHttpRequest();
            request.open("POST", "/newsletter");
            request.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}')
            request.send(formData);
            document.getElementById('create-ticket').innerText = 'Newsletter is being Created Please Wait.......'
            document.getElementById('create-ticket').disable = true
            request.onreadystatechange = function () {
                if (request.readyState == XMLHttpRequest.DONE) {
                    var jsonResponse = JSON.parse(request.responseText)
                    alert(jsonResponse.data);

                }

                request.onload = function () {
                    window.location = '/newsletter';

                    //document.getElementById('create-ticket').innerText = 'Create Ticket'

                }
            }

        }
    </script>

@endsection
