<?php

namespace App\Http\Controllers;

use App\Imports\ClientsImport;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class ClientController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->get('search');

        $clients = Client::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Clients/Index', [
            'clients' => $clients
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * @param StoreClientRequest $request
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        Client::query()->create($request->validated());

        return to_route('clients.index');
    }

    public function importExcel(Request $request): JsonResponse|Response
    {
        try {
            $clients = $this->processExcelData($request);

            return response()->json([
                'clients' => $clients,
                'message' => 'Список клиентов успешно загружен'
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (Exception $e) {
            return response()->json(['error' => 'Произошла ошибка при попытке сохранения данных'], 500);
        }
    }

    private function processExcelData(Request $request)
    {
        $clients = [];

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($this->isValidFileExtension($file)) {
                $importedData = Excel::toArray(new ClientsImport, $file);

                foreach ($importedData[0] as $data) {
                    if ($this->isValidClientData($data)) {
                        $client = $this->saveClientsFromExcel($data);
                        $clients[] = $client;
                    }
                }
            } else {
                $error = 'Недопустимый формат файла!';
                throw new \InvalidArgumentException($error);
            }
        } else {
            $error = 'Файл не был загружен.';
            throw new \InvalidArgumentException($error);
        }

        // Removes empty values
        return array_filter($clients);
    }

    private function isValidFileExtension($file): bool
    {
        $extension = $file->getClientOriginalExtension();

        return in_array($extension, ['xlsx', 'xls']);
    }

    private function isValidClientData(array $data): bool
    {
        return !empty($data['fio']) ||
            !empty($data['telefon']) ||
            !empty($data['email']) ||
            !empty($data['den_rozdeniia']);
    }

    private function saveClientsFromExcel(array $data): Client
    {
        $excelBaseDate = strtotime('1899-12-30');
        $birthday = date('Y-m-d', $excelBaseDate + $data['den_rozdeniia'] * 86400);
        $phoneNumber = str_replace('=', '', $data['telefon']);

        $client = new Client([
            'name' => $data['fio'],
            'phone' => $phoneNumber,
            'email' => $data['email'],
            'birthday' => $birthday,
        ]);
        $client->save();

        return $client;
    }

//    /**
//     * @param Request $request
//     * @return JsonResponse|Response
//     */
//    public function importExcel(Request $request): JsonResponse|Response
//    {
//        try {
//            $clients = [];
//
//            if ($request->hasFile('file')) {
//                $file = $request->file('file');
//
//                if ($file->getClientOriginalExtension() == 'xlsx' || $file->getClientOriginalExtension() == 'xls') {
//                    $importedData = Excel::toArray(new ClientsImport, $file);
//
//                    foreach ($importedData[0] as $data) {
//                        if (!empty($data['fio']) ||
//                            !empty($data['telefon']) ||
//                            !empty($data['email']) ||
//                            !empty($data['den_rozdeniia'])
//                        ) {
//                            $excelBaseDate = strtotime('1899-12-30');
//                            $birthday = date('Y-m-d', $excelBaseDate + $data['den_rozdeniia'] * 86400);
//                            $phoneNumber = str_replace('=', '', $data['telefon']);
//
//                            $client = new Client([
//                                'name' => $data['fio'],
//                                'phone' => $phoneNumber,
//                                'email' => $data['email'],
//                                'birthday' => $birthday,
//                            ]);
//                            $client->save();
//                            $clients[] = $client;
//                        }
//                    }
//
//                    $dataWithoutEmptyStrings = array_filter($clients, function ($value) {
//                        return !empty($value);
//                    });
//                } else {
//                    $error = 'Недопустимый формат файла!';
//                    return response()->json(['error' => $error], 400);
//                }
//            } else {
//                $error = 'Файл не был загружен.';
//                return response()->json(['error' => $error], 400);
//            }
//
//            return response()->json(['clients' => $dataWithoutEmptyStrings, 'message' => 'Список клитентов успешно загружен']);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'Произошла ошибка при попытке сохранения данных'], 500);
//        }
//    }
}
