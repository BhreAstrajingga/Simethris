<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berkas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBerkasRequest;
use App\Http\Requests\UpdateBerkasRequest;
use App\Http\Requests\MassDestroyBerkasRequest;
use App\Models\PullRiph;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DateTime;
use DateTimeZone;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexberkas()
    {
        abort_if(Gate::denies('berkas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realnpwp = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? '');
        $pullRiph = PullRiph::where('npwp', $realnpwp)->first();
        $dataUser = Auth::user()::find(Auth::user()->id)->data_user;
        
        $npwp = str_replace('.', '', $realnpwp);
        $npwp = str_replace('-', '', $npwp);

        $data_berkas = new Collection(); 
        $item = [];
        if (!empty($pullRiph->formRiph)){
            $item += array('berkas' => 'Form-RIPH');
            $item += array('filename' => basename($pullRiph->formRiph));
            $exists = Storage::disk('public')->exists($pullRiph->formRiph);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRiph);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            $item += array('fullpath' => '/'.$pullRiph->formRiph);
            $data_berkas->push($item);
        }
        
        $item = [];
        if (!empty($pullRiph->formSptjm)){
            $item += array('berkas' => 'Form-SPTJM');
            $item += array('filename' => basename($pullRiph->formSptjm));
            $exists = Storage::disk('public')->exists($pullRiph->formSptjm);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formSptjm);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formSptjm);
            $data_berkas->push($item);
        }


        $item = [];
        if (!empty($pullRiph->formRt)){
            $item += array('berkas' => 'Form-RT');
            $item += array('filename' => basename($pullRiph->formRt));
            $exists = Storage::disk('public')->exists($pullRiph->formRt);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRt);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formRt);
            $data_berkas->push($item);
        }

        $item = [];
        if (!empty($pullRiph->formRta)){
            $item += array('berkas' => 'Form-RTA');
            $item += array('filename' => basename($pullRiph->formRta));
            $exists = Storage::disk('public')->exists($pullRiph->formRta);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRta);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formRta);
            $data_berkas->push($item);
        }

        $item = [];
        if (!empty($pullRiph->formRpo)){
            $item += array('berkas' => 'Form-RPO');
            $item += array('filename' => basename($pullRiph->formRpo));
            $exists = Storage::disk('public')->exists($pullRiph->formRpo);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRpo);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formRpo);
            $data_berkas->push($item);
        }

        $item = [];
        if (!empty($pullRiph->formLa)){
            $item += array('berkas' => 'Form-La');
            $item += array('filename' => basename($pullRiph->formLa));
            $exists = Storage::disk('public')->exists($pullRiph->formLa);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formLa);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formLa);
            $data_berkas->push($item);
        }
        
        
        $item = [];
        if (!empty($pullRiph->logBook)){
            $item += array('berkas' => 'Log Book');
            $item += array('filename' => basename($pullRiph->logBook));
            $exists = Storage::disk('public')->exists($pullRiph->logBook);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->logBook);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->logBook);
            $data_berkas->push($item);
        }
        $item = [];
        if (!empty($dataUser->assignment)){
            $item += array('berkas' => 'Surat Assignment');
            $item += array('filename' => basename($dataUser->assignment));
            $exists = Storage::disk('public')->exists($dataUser->assignment);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($dataUser->assignment);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$dataUser->assignment);
            $data_berkas->push($item);
        }
        $module_name = 'Proses RIPH' ;
        $page_title = 'Berkas Saya';
        $page_heading = 'Berkas Saya' ;
        $heading_class = 'fa fa-file';
        return view('admin.folder.indexberkas', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'data_berkas',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    'npwp'));
    
    }

    public function indexgaleri()
    {
        abort_if(Gate::denies('galeri_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataUser = Auth::user()::find(Auth::user()->id)->data_user;

        $data_berkas = new Collection(); 
        $item = [];
        if (!empty($dataUser->avatar)){
            $item += array('berkas' => 'Avatar');
            $item += array('filename' => basename($dataUser->avatar));
            $exists = Storage::disk('public')->exists($dataUser->avatar);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($dataUser->avatar);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            $item += array('fullpath' => '/'.$dataUser->avatar);
            $data_berkas->push($item);
        }

        $item = [];
        if (!empty($dataUser->logo)){
            $item += array('berkas' => 'Logo perusahaan');
            $item += array('filename' => basename($dataUser->logo));
            $exists = Storage::disk('public')->exists($dataUser->logo);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($dataUser->logo);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            $item += array('fullpath' => '/'.$dataUser->logo);
            $data_berkas->push($item);
        }

        $item = [];
        if (!empty($dataUser->ktp_image)){
            $item += array('berkas' => 'Foto KTP');
            $item += array('filename' => basename($dataUser->ktp_image));
            $exists = Storage::disk('public')->exists($dataUser->ktp_image);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($dataUser->ktp_image);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            $item += array('fullpath' => '/'.$dataUser->ktp_image);
            $data_berkas->push($item);
        }


        $module_name = 'Proses RIPH' ;
        $page_title = 'Galeri Saya';
        $page_heading = 'Galeri Saya' ;
        $heading_class = 'fa fa-image';
        return view('admin.folder.indexgaleri', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'data_berkas'));
    
    }

    public function indextemplate(Request $request)
    {
        abort_if(Gate::denies('template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            
            $query = Berkas::select(sprintf('%s.*', (new Berkas())->table));
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'template_show';
                $editGate = 'template_edit';
                $deleteGate = 'template_delete';
                $crudRoutePart = 'task.template';
                $fullpath = Storage::disk('public')->url('uploads/master/'. $row->name);

                return view('partials.berkasActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row',
                'fullpath'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('kind', function ($row) {
                return $row->kind ? $row->kind : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? date('d/m/Y', strtotime($row->created_at)) : '';
            });
            
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $roleaccess = Auth::user()->roleaccess;
        if ($roleaccess==1)
            $module_name = 'Administrator' ;
        else 
            $module_name = 'Proses RIPH' ;
        $page_title = 'Template Master';
        $page_heading = 'Template Master' ;
        $heading_class = 'fa fa-file-upload';
        return view('admin.folder.indextemplate', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtemplate()
    {
        abort_if(Gate::denies('template_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $module_name = 'Administrator' ;
        $page_title = 'Template Master';
        $page_heading = 'Create Template Master' ;
        $heading_class = 'fa fa-folder';
        return view('admin.folder.createtemplate', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storetemplate(StoreBerkasRequest $request)
    {
        $regdata = [
            'kind'        => $request->string('kind', ''),
            'description' => $request->string('description', '') 
        ];
        
        if  ($request['fileUnggah']!=null){
            $file_name = $request['fileUnggah']->getClientOriginalName();
            $file_path = $request['fileUnggah']->storeAs('uploads/master', $file_name, 'public');
            $master_path = $file_name;
            $regdata += array('name' => $master_path);
        };
        $berkas = Berkas::create($regdata);
        if ($berkas){
            session()->flash('message', __('Master template berhasil ditambahkan'));
            return redirect()->route('admin.task.template');
        }
        else 
            return back()->withErrors(['error' => 'Error tambah master template']);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function showtemplate(Berkas $berkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function edittemplate(Berkas $berkas)
    {

        abort_if(Gate::denies('template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $module_name = 'Administrator' ;
        $page_title = 'Template Master';
        $page_heading = 'Edit Template Master' ;
        $heading_class = 'fa fa-folder';
        return view('admin.folder.edittemplate', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'berkas'));
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function updatetemplate(UpdateBerkasRequest $request, Berkas $berkas)
    {
        //$berkas->update($request->all());
        $regdata = [
            'kind'        => $request->string('kind', ''),
            'description' => $request->string('description', '') 
        ];
        
        if  ($request['fileUnggah']!=null){
            $file_name = $request['fileUnggah']->getClientOriginalName();
            $file_path = $request['fileUnggah']->storeAs('uploads/master', $file_name, 'public');
            $master_path = $file_name;
            $regdata += array('name' => $master_path);
        };
        $berkas->update($regdata);
        if ($berkas){
            session()->flash('message', __('Master template berhasil diubah'));
            return redirect()->route('admin.task.template');
        }
        else 
            return back()->withErrors(['error' => 'Error ubah master template']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function destroytemplate($id)
    {
        abort_if(Gate::denies('template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkas = Berkas::find($id);

        if ($berkas){
            try {
                if (Storage::disk('public')->exists('uploads/master/'.$berkas->name)){
                    Storage::disk('public')->delete('uploads/master/'.$berkas->name); 
                      
                }
            }
            catch(\Exception $e)
            {
                return back()->withErrors(['error' => 'Berkas gagal dihapus']);    
            } finally {
                $berkas->delete();
            }
        }

        return back()->withErrors(['error' => 'Berkas telah dihapus']);
        
    }

    public function massDestroy(MassDestroyBerkasRequest $request)
    {
        Berkas::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}


