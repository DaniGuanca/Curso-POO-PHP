public class Material
{
    public int id { get; set };
    public string nombre { get; set };
    public double precio { get; set };
    public int stock { get; set };

    public ActualizarPrecio(double valor)
    {
        this.precio = valor;
    }

}