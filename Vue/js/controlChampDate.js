(function controlDate(jour, mois, annee)
{
    var desactivation = 0;

    if (jour != 0 && mois != 0 && annee != 0)
    {
        // On vérifie l'année et le mois
        var anneeMax = new Date().getFullYear();
        if (annee < 1900 || annee > anneeMax || mois == 0 || mois > 12)
            desactivation = 1;

        var moisLongeur = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        // On gère les années bisextiles
        if (annee % 400 == 0 || (annee % 100 != 0 && annee % 4 == 0))
            moisLongeur[1] = 29;

        // On vérifie le jour en fonction du mois
        if (jour < 0 || jour > moisLongeur[mois - 1])
            desactivation = 1;

        return desactivation;
    }
    else
        return 1;
});