@extends('layouts.admin')
@section('style')
    @parent
    <style>
        .image-preview {
            max-width: 300px;
            max-height: 300px;
            margin: 10px 0;
            display: none;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background: #f4f3ef;
            border-radius: 4px;
        }
        .custom-file-upload:hover {
            background: #e8e7e3;
        }
        #image {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Add Image to Room Gallery</h4>
                        </div>
                        <div class="content">
                            {!! Form::open(array('url' => 'admin/room_type/'.$room_type->id.'/image', 'id' => 'room_type-add-form', 'files' => true)) !!}
                            {{ Form::hidden('_method', 'POST') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image<star>*</star></label>
                                        <div>
                                            <label class="custom-file-upload">
                                                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(this);">
                                                <i class="ti-image"></i> Choose Image
                                            </label>
                                        </div>
                                        <img id="preview" class="image-preview">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Caption</label>
                                        <input type="text" name="caption" class="form-control border-input" placeholder="Enter image caption">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Is Primary</label>
                                        <select name="is_primary" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Add Image</button>
                            </div>
                            <div class="clearfix"></div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

