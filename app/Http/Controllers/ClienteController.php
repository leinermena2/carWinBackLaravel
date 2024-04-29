<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\GanadorEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    // Crear un nuevo cliente
    public function store(Request $request)
    {
    try {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cedula' => 'required|numeric|unique:clientes,cedula',
            'departamento' => 'required|string',
            'ciudad' => 'required|string',
            'celular' => 'required|numeric|unique:clientes,celular',
            'correo_electronico' => 'required|email|unique:clientes,correo_electronico',
            'habeas_data' => 'required|boolean',
        ]);
    } catch (ValidationException $e) {
        $errors = $e->validator->errors()->all();
        return response()->json(['message' => 'Error de validacion', 'errors' => $errors], 422);
    }

    Cliente::create($request->all());

    return response()->json(['message' => 'Cliente creado correctamente'], 201);
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'cedula' => 'required|numeric',
            'departamento' => 'required|string',
            'ciudad' => 'required|string',
            'celular' => 'required|numeric',
            'correo_electronico' => 'required|email',
            'habeas_data' => 'required|boolean',
        ]);

        $cliente->update($request->all());

        return response()->json(['message' => 'Cliente actualizado correctamente'], 200);
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente'], 200);
    }

    // Obtener todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes, 200);
    }

    // Seleccionar un ganador al azar entre los clientes
    public function seleccionarGanador()
    {
        $numClientes = Cliente::where('winner', false)->count();
    
        if ($numClientes < 5) {
            return response()->json(['message' => 'No hay suficientes clientes elegibles para seleccionar un ganador', "status" => 500], 200);
        }
    
        $ganador = Cliente::where('winner', false)->inRandomOrder()->first();
    
        $ganador->update(['winner' => true]);
    
        $correoGanador = $ganador->correo_electronico;
    
        try {
            Mail::to($correoGanador)->send(new GanadorEmail($ganador));
        } catch (\Swift_TransportException $e) {
            return response()->json(['message' => 'Error al enviar el correo electrónico al ganador', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al enviar el correo electrónico al ganador', 'error' => $e->getMessage()], 500);
        }
    
        return response()->json(['message' => 'Ganador seleccionado y correo electrónico enviado correctamente', "ganador" => $ganador->nombre.' '. $ganador->apellido, "status" => 200], 200);
    }

    // Obtener clientes según el estado de "winner"
    public function obtenerClientesPorEstado($estado)
    {
        
        if (intval($estado) !== 0 && intval($estado) !== 1) {
            return response()->json(['message' => 'El estado debe ser 0 o 1'.' '.$estado], 400);
        }
        $clientes = Cliente::where('winner', $estado)->get();

        if ($clientes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron clientes con el estado especificado'], 404);
        }

        return response()->json($clientes, 200);
    }
    
}
