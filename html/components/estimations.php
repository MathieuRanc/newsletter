<?php
function timeWebsite($project)
{
  $hours = 0;
  $monthHours = 0;
  $yearHours = 0;

  if ($project['type'] === 'e-commerce') {
    $hours += 20;
    $monthHours += 1;
    $yearHours += 12;
  } elseif ($project['type'] === 'vitrine') {
    $hours += 6;
  } elseif ($project['type'] === 'refonte') {
    $hours += 3;
  } elseif ($project['type'] === 'mobile') {
    $hours += 30;
    $monthHours += 1;
    $yearHours += 12;
  }

  if ($project['code'] === 'wordpress') {
    $hours += 2;
    $monthHours += 0.5;
    $yearHours += 6;
  } elseif ($project['code'] === 'code') {
    $hours += 10;
  }

  if ($project['charter'] === 'logo') {
    $hours += 4;
  } elseif ($project['charter'] === 'couleurs') {
    $hours += 1;
  } elseif ($project['charter'] === 'polices') {
    $hours += 2;
  }

  if (str_contains($project['design'], 'simple')) {
    $hours += 4;
  } elseif (str_contains($project['design'], 'classique')) {
    $hours += 8;
  } elseif (str_contains($project['design'], 'advanced')) {
    $hours += 18;
  }

  if ($project['translate'] === 'oui') {
    $hours += 4;
  } elseif ($project['translate'] === 'non') {
    $hours += 0;
  }

  if ($project['payment'] === 'cb-paypal') {
    $hours += 4;
  } elseif ($project['payment'] === 'abonnements') {
    $hours += 6;
    $monthHours += 0.5;
    $yearHours += 6;
  } elseif ($project['payment'] === 'non') {
    $hours += 0;
  }

  if ($project['accounts'] === 'oui') {
    $hours += 6;
  } elseif ($project['accounts'] === 'non') {
    $hours += 0;
  }

  if (str_contains($project['fonctionnalites'], 'blog')) {
    $hours += 4;
  }
  if (str_contains($project['fonctionnalites'], 'a-simples')) {
    $hours += 4;
  }
  if (str_contains($project['fonctionnalites'], 'a-complexes')) {
    $hours += 10;
  }
  if (str_contains($project['fonctionnalites'], 'social')) {
    $hours += 2;
  }
  if (str_contains($project['fonctionnalites'], 'newsletter')) {
    $hours += 1;
    $monthHours += 0.5;
    $yearHours += 6;
  }
  if (str_contains($project['fonctionnalites'], 'recherche')) {
    $hours += 2;
  }
  if (str_contains($project['fonctionnalites'], 'rdv')) {
    $hours += 4;
  }
  if (str_contains($project['fonctionnalites'], 'devis')) {
    $hours += 8;
  }
  if (str_contains($project['fonctionnalites'], 'factures')) {
    $hours += 8;
  }
  if (str_contains($project['fonctionnalites'], 'crm-erp')) {
    $hours += 4;
  }

  if (str_contains($project['pages'], 'accueil')) {
    $hours += 1;
  }
  if (str_contains($project['pages'], 'equipe')) {
    $hours += 2;
  }
  if (str_contains($project['pages'], 'a-propos')) {
    $hours += 1;
  }
  if (str_contains($project['pages'], 'whoami')) {
    $hours += 1;
  }
  if (str_contains($project['pages'], 'portfolio')) {
    $hours += 4;
  }
  if (str_contains($project['pages'], 'faq')) {
    $hours += 4;
  }
  if (str_contains($project['pages'], 'contact')) {
    $hours += 1;
  }

  if ($project['hosting'] === 'non') {
    $hours += 0;
  } elseif ($project['hosting'] === 'standart') {
    $hours += 4;
  } elseif ($project['hosting'] === 'premium') {
    $hours += 4;
  }

  if (str_contains($project['seo'], 'mots-cles')) {
    $hours += 1;
    $monthHours += 0.5;
    $yearHours += 6;
  }
  if (str_contains($project['seo'], 'contenu')) {
    $hours += 2;
  }
  if (str_contains($project['seo'], 'mois')) {
    $hours += 0;
    $monthHours += 0.5;
    $yearHours += 6;
  }
  if (str_contains($project['seo'], 'semaines')) {
    $monthHours += 2;
    $yearHours += 24;
  }
  if (str_contains($project['seo'], 'social')) {
    $hours += 4;
  }
  if (str_contains($project['seo'], 'sitemap')) {
    $hours += 1;
  }
  if (str_contains($project['seo'], 'payant')) {
    $hours += 0;
  }

  if ($project['content'] === 'client') {
    $hours += 0;
  } elseif ($project['content'] === 'agence') {
    $hours += 4;
  }

  if (str_contains($project['stats'], 'position')) {
    $hours += 0;
  }
  if (str_contains($project['stats'], 'clics')) {
    $hours += 0;
  }
  if (str_contains($project['stats'], 'validitee')) {
    $hours += 0;
  }
  if (str_contains($project['stats'], 'ergonomie')) {
    $hours += 0;
  }
  if (str_contains($project['stats'], 'securitée')) {
    $hours += 0;
  }
  if (str_contains($project['stats'], 'ameliorations')) {
    $hours += 0;
  }

  if (str_contains($project['maintenance'], 'non')) {
    $hours += 0;
  }
  if (str_contains($project['maintenance'], 'essentielle')) {
    $hours += 0;
  }
  if (str_contains($project['maintenance'], 'premium')) {
    $hours += 0;
  }

  return ["hours" => $hours, "month_hours" => $monthHours, "year_hours" => $yearHours];
}
