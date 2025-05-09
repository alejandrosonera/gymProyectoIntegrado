<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index() {
        $productos = Producto::all();
        return view('tienda.index', compact('productos'));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tienda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate($this->rules());

        // Verificar si hay imagen y procesarla
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
            $validated['imagen'] = $rutaImagen;
        }

        // Crear el producto con los datos validados
        Producto::create($validated);

        return redirect()->route(('productos.index'))->with('mensaje', 'Producto creado correctamente');
    }



    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('tienda.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validación de los datos
        $datos = $request->validate($this->rules($producto->id));

        // Comprobar si se ha subido una nueva imagen
        if ($request->hasFile('imagen')) {
            // Almacenar la nueva imagen
            $datos['imagen'] = $request->imagen->store('images/productos/', 'public');

            // Eliminar la imagen anterior si no es la imagen predeterminada
            if (basename($producto->imagen) != 'noimage.jpeg') {
                Storage::delete($producto->imagen);
            }
        } else {
            // Si no hay nueva imagen, mantener la imagen existente
            $datos['imagen'] = $producto->imagen;
        }

        // Actualizar el producto con los nuevos datos
        $producto->update($datos);

        // Redirigir con mensaje de éxito
        return redirect()->route('productos.index')->with('mensaje', "Producto editado correctamente");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('mensaje', "Producto eliminado correctamente");
    }

    private function rules(?int $id=null): array {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:25', 'unique:productos,nombre,' . $id],
            'descripcion' => ['required', 'string', 'min:10', 'max:50'],
            'stock' => ['required', 'integer'],
            'precio' => ['required', 'numeric', 'min:0.01'],
            'imagen' => ['required', 'image', 'max:2048'],
        ];
    }
}
