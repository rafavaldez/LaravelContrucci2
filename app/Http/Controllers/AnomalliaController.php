<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnomalliaController extends Controller
{
    public function showanalisis()
    {
        return view('analisis_anomalia.analisis_anomalia');
    }

    public function adminResultadosAnalisis(Request $request)
    {
        try {
            $uploadedFilename = Session::get('uploaded_filename');
            $filename = $request->input('filename');
            $idDatajson = $request->input('id_json');

            // Verificar si es un formulario POST
            if ($request->isMethod('post')) {
                $dataDict = json_decode($filename, true);
                $dataStr = json_encode($filename);
                return view('analisis_anomalia.resultado_analisis', ['filename' => $dataStr, 'data_json' => $dataStr, 'id_datajson' => $idDatajson]);
            } else {
                $utcNow = Carbon::now()->utc();
                $peruNow = $utcNow->subHours(5);
                $currentTime = $peruNow->format('Y-m-d H:i:s');

                $data = [
                    'uploaded_filename' => $uploadedFilename,
                    'filename' => $filename,
                    'id_json' => $idDatajson,
                    'current_time' => $currentTime,
                    'user_id' => Session::get('user_id'),
                ];

                // Hacer la solicitud a la API
                $response = Http::post('http://tu-api-url.com/admin/ResultadosAnalisis', $data);

                if ($response->successful()) {
                    $responseData = $response->json();
                    return view('admin.charts', [
                        'filename' => $filename,
                        'data_json' => $responseData['data_json'],
                        'anomalies' => $responseData['anomalies'],
                        'id_datajson' => $responseData['id_datajson'],
                    ]);
                } else {
                    return response()->json(['error' => 'Error al consumir la API']);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destino(Request $request)
    {
        // Imprimir mensaje en el log
        \Log::info('Llegó a destino');

        // Obtener los datos del cuerpo de la solicitud
        $data = $request->json()->all();

        // Acceder a la fila seleccionada y al conjunto completo de datos
        $selectedRow = $data['selectedRow'] ?? [];
        $allData = $data['allData'] ?? [];
        $idDatajson = $data['idDataJson'] ?? '';

        // Almacenar los datos en la sesión del usuario
        Session::put('selected_row', $selectedRow);
        Session::put('all_data', $allData);
        Session::put('id_datajson', $idDatajson);

        return response()->json('Datos almacenados en la sesión');
    }


    public function adminDestino()
    {
        // Recupera los datos almacenados en la sesión
        $selectedRow = Session::pull('selected_row', []);
        $allData = Session::pull('all_data', []);
        $idDatajson = Session::pull('id_datajson', '');

        $marcaIndex = 13;  // Ajusta el índice según la posición real de 'marca' en tu lista
        $nombreIndex = 12;  // Ajusta el índice según la posición real de 'nombre' en tu lista
        $fechaCompraIndex = 7;  // Ajusta el índice según la posición real de 'fecha_compra' en tu lista
        $precioUnitarioIndex = 14;  // Ajusta el índice según la posición real de 'precio_unitario' en tu lista

        // Obtén los valores directamente de selected_row
        $marca = isset($selectedRow[$marcaIndex]) ? $selectedRow[$marcaIndex] : '';
        $nombre = isset($selectedRow[$nombreIndex]) ? $selectedRow[$nombreIndex] : '';
        $fechaCompra = isset($selectedRow[$fechaCompraIndex]) ? $selectedRow[$fechaCompraIndex] : '';

        // Obtén el mes de compra a partir de la fecha de compra
        $fechaCompraObj = !empty($fechaCompra) ? Carbon::createFromFormat('Y-m-d', $fechaCompra) : null;
        $mesCompra = $fechaCompraObj ? $fechaCompraObj->month : null;

        // Convierte 'precio_unitario' a float
        $precioUnitario = isset($selectedRow[$precioUnitarioIndex]) ? floatval($selectedRow[$precioUnitarioIndex]) : 0.0;

        // Codificar variables categóricas (suponiendo que tienes una función de codificación o una clase)
        $encodedFeatures = $this->encodeFeatures($marca, $nombre, $mesCompra);

        // Combinar características codificadas y precio unitario para realizar la predicción
        $X = array_merge($encodedFeatures, [$precioUnitario]);
        $pricePrediction = $this->predictPrice($X);

        // Renderizar la plantilla con los datos
        return view('analisis_anomalia.resultado_anomalia_detalle', [
            'selected_row' => $selectedRow,
            'all_data' => $allData,
            'prediction' => $pricePrediction,
            'id_datajson' => $idDatajson
        ]);
    }

    public function registrarTramite(Request $request)
    {
        $data = $request->json()->all();

        // Desglosar cada campo del JSON
        $prioridadAnomalia = $data['prioridadAnomalia'] ?? null;
        $estadoAnomalia = $data['estadoAnomalia'] ?? null;
        $asunto = $data['asunto'] ?? null;
        $contenidoSolicitud = $data['contenidoSolicitud'] ?? null;
        $idDatajson = $data['idDataJson'] ?? null;
        $selectedRow = $data['selectedRow'] ?? null;
        $allData = $data['allData'] ?? null;
        $allDataString = json_encode($allData, JSON_UNESCAPED_UNICODE);
        $rowIndex = $data['rowIndex'] ?? null;

        // Conectar con MongoDB y seleccionar la colección
        $client = new MongoClient('mongodb://localhost:27017');
        $collection = $client->tu_base_de_datos->documentos;

        // Buscar el documento en MongoDB utilizando idDatajson
        $documento = $collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($idDatajson)]);

        if ($documento) {
            // Reemplazar el data_json con allData
            $collection->updateOne(
                ['_id' => new \MongoDB\BSON\ObjectId($idDatajson)],
                ['$set' => ['data_json' => $allDataString]]
            );

            // Crear el subdocumento reporte
            $nuevoReporte = [
                'index_anomalia' => $rowIndex,
                'selected_row' => $selectedRow,
                'prioridad_anomalia' => $prioridadAnomalia,
                'estado_anomalia' => $estadoAnomalia,
                'asunto' => $asunto,
                'contenidoSolicitud' => $contenidoSolicitud
            ];

            // Agregar el subdocumento reporte al documento
            $collection->updateOne(
                ['_id' => new \MongoDB\BSON\ObjectId($idDatajson)],
                ['$push' => ['reporte' => $nuevoReporte]]
            );

            $mensaje = "Trámite registrado y documento actualizado exitosamente";
        } else {
            $mensaje = "Documento no encontrado";
        }

        // Responder al cliente
        return response()->json(['mensaje' => $mensaje]);
    }



    public function adminHistorialAnomalias(Request $request)
    {
        if (Session::has('user_id')) {
            $userId = Session::get('user_id');

            // Conectar con MongoDB y seleccionar la colección
            $client = new MongoClient('mongodb://localhost:27017');
            $collection = $client->tu_base_de_datos->documentos;

            // Buscar los documentos del usuario
            $userDocuments = $collection->find(['usuario' => $userId]);

            // Convertir los documentos a un array
            $documents = iterator_to_array($userDocuments);

            return view('analisis_anomalia.historial_anomalia', ['documents' => $documents]);
        }

        return Redirect::route('home');
    }


    public function adminResultadosInforme(Request $request)
    {
        try {
            $reportes = $request->input('reporte');

            if ($reportes) {
                // Convertir la cadena JSON de vuelta a un array de arrays
                $reportesArray = json_decode(str_replace("'", '"', $reportes), true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    // Renderizar la plantilla informe y pasarle los reportes
                    return view('analisis_anomalia.informe_anomalia', ['reportes' => $reportesArray]);
                } else {
                    return response()->json(['error' => 'Error al decodificar JSON']);
                }
            } else {
                return response()->json(['error' => 'No se recibieron datos de reporte']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }















    public function upload(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file part']);
        }

        $file = $request->file('file');

        if (!$file->isValid() || $file->getClientOriginalName() === '') {
            return response()->json(['error' => 'No selected file']);
        }

        // Guarda el archivo en la carpeta UPLOAD_FOLDER
        $path = $file->storeAs('uploads', $file->getClientOriginalName());

        // Intenta cargar el archivo CSV o Excel
        try {
            if ($file->getClientOriginalExtension() === 'csv') {
                $data = array_map('str_getcsv', file(storage_path('app/' . $path)));
            } elseif (in_array($file->getClientOriginalExtension(), ['xls', 'xlsx'])) {
                $data = Excel::toArray(new GenericImport, storage_path('app/' . $path));
            } else {
                return response()->json(['error' => 'Formato de archivo no admitido']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar el archivo: ' . $e->getMessage()]);
        }

        $dataJson = json_encode($data);

        // Guarda los datos procesados en la sesión
        Session::put('uploaded_filename', $dataJson);
        Session::put('uploaded_filename_name', $file->getClientOriginalName());

        return response()->json(['data' => $dataJson]);
    }






}
