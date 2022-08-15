public class Obra
{
    public int id { get; set };
    public string nombre { get; set };
    public date fechaInicio { get; set };
    public double porcentajeFinalizacion { get; set };
    private double total;
    public List<MaterialObra> MaterialObra { get; set; }
    private double total;

    public static int CalcularTotal()
    {
        if (this.porcentajeFinalizacion == 100)
        {
            foreach (var insumo in MaterialObra)
            {
                this.total += (insumo.material.precio * insumo.cantidad);
                return this.total;
            }
        }else
        {
            throw new Exception("Obra no finalizada");
        }
    }

}