<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion de Formation</title>
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
<script>
tailwind.config = {
theme: {
extend: {
colors: {
primary: '#4F46E5',
secondary: '#6B7280'
},
borderRadius: {
'none': '0px',
'sm': '4px',
DEFAULT: '8px',
'md': '12px',
'lg': '16px',
'xl': '20px',
'2xl': '24px',
'3xl': '32px',
'full': '9999px',
'button': '8px'
}
}
}
}
</script>
<style>
:where([class^="ri-"])::before { content: "\f3c2"; }
.chart-container { width: 100%; height: 240px; }
</style>
</head>
<body class="bg-gray-50">
<div class="min-h-screen flex">
<aside class="w-64 bg-white shadow-lg">
<div class="p-4 flex items-center gap-2">
<span class="font-['Pacifico'] text-2xl text-primary">logo</span>
</div>
<nav class="mt-8">
<a href="#" class="flex items-center px-4 py-3 text-primary bg-indigo-50">
<div class="w-5 h-5 flex items-center justify-center mr-3">
<i class="ri-dashboard-line"></i>
</div>
<span>Tableau de bord</span>
</a>
<a href="https://readdy.ai/home/cb4c0449-3742-42d5-8109-f632fe577fef/2230f12e-0ff6-4963-b85b-eb0fc0e589da" data-readdy="true" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
<div class="w-5 h-5 flex items-center justify-center mr-3">
<i class="ri-user-line"></i>
</div>
<span>Élèves</span>
</a>
<a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
<div class="w-5 h-5 flex items-center justify-center mr-3">
<i class="ri-team-line"></i>
</div>
<span>Enseignants</span>
</a>
<a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
<div class="w-5 h-5 flex items-center justify-center mr-3">
<i class="ri-book-open-line"></i>
</div>
<span>Cours</span>
</a>
<a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50">
<div class="w-5 h-5 flex items-center justify-center mr-3">
<i class="ri-file-chart-line"></i>
</div>
<span>Rapports</span>
</a>
</nav>
</aside>
<main class="flex-1">
<header class="bg-white shadow-sm">
<div class="flex items-center justify-between px-8 py-4">
<div class="relative">
<div class="absolute inset-y-0 left-0 flex items-center pl-3">
<div class="w-5 h-5 flex items-center justify-center text-gray-400">
<i class="ri-search-line"></i>
</div>
</div>
<input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 w-96 rounded-lg border-none bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
</div>
<div class="flex items-center gap-4">
<button class="relative !rounded-button">
<div class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-50 rounded-full">
<i class="ri-notification-line"></i>
</div>
<span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
</button>
<button class="flex items-center gap-2 !rounded-button">
<img src="https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20middle%20aged%20french%20woman%20with%20short%20brown%20hair%2C%20wearing%20business%20attire%2C%20natural%20lighting%2C%20neutral%20background&width=40&height=40&seq=1&orientation=squarish" class="w-10 h-10 rounded-full object-cover">
<span class="text-sm font-medium">Marie Dubois</span>
<div class="w-5 h-5 flex items-center justify-center">
<i class="ri-arrow-down-s-line"></i>
</div>
</button>
</div>
</div>
</header>
<div class="p-8">
<div class="grid grid-cols-4 gap-6">
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex items-center justify-between">
<div>
<p class="text-sm text-gray-500">Total Élèves</p>
<p class="text-2xl font-semibold mt-1">248</p>
</div>
<div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
<i class="ri-user-line"></i>
</div>
</div>
<div class="mt-4 flex items-center text-sm">
<div class="w-4 h-4 flex items-center justify-center text-green-500">
<i class="ri-arrow-up-line"></i>
</div>
<span class="text-green-500 font-medium">12%</span>
<span class="text-gray-500 ml-1">vs mois dernier</span>
</div>
</div>
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex items-center justify-between">
<div>
<p class="text-sm text-gray-500">Total Enseignants</p>
<p class="text-2xl font-semibold mt-1">16</p>
</div>
<div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
<i class="ri-team-line"></i>
</div>
</div>
<div class="mt-4 flex items-center text-sm">
<div class="w-4 h-4 flex items-center justify-center text-green-500">
<i class="ri-arrow-up-line"></i>
</div>
<span class="text-green-500 font-medium">4%</span>
<span class="text-gray-500 ml-1">vs mois dernier</span>
</div>
</div>
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex items-center justify-between">
<div>
<p class="text-sm text-gray-500">Cours Actifs</p>
<p class="text-2xl font-semibold mt-1">32</p>
</div>
<div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
<i class="ri-book-open-line"></i>
</div>
</div>
<div class="mt-4 flex items-center text-sm">
<div class="w-4 h-4 flex items-center justify-center text-green-500">
<i class="ri-arrow-up-line"></i>
</div>
<span class="text-green-500 font-medium">8%</span>
<span class="text-gray-500 ml-1">vs mois dernier</span>
</div>
</div>
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex items-center justify-between">
<div>
<p class="text-sm text-gray-500">Taux de Réussite</p>
<p class="text-2xl font-semibold mt-1">92%</p>
</div>
<div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
<i class="ri-line-chart-line"></i>
</div>
</div>
<div class="mt-4 flex items-center text-sm">
<div class="w-4 h-4 flex items-center justify-center text-green-500">
<i class="ri-arrow-up-line"></i>
</div>
<span class="text-green-500 font-medium">2%</span>
<span class="text-gray-500 ml-1">vs mois dernier</span>
</div>
</div>
</div>
<div class="grid grid-cols-2 gap-6 mt-6">
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex items-center justify-between mb-6">
<h3 class="font-semibold">Progression des Inscriptions</h3>
<button class="text-sm text-gray-500 hover:text-gray-700 !rounded-button">Cette Année</button>
</div>
<div class="chart-container" id="enrollmentChart"></div>
</div>
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex items-center justify-between mb-6">
<h3 class="font-semibold">Distribution des Niveaux</h3>
<button class="text-sm text-gray-500 hover:text-gray-700 !rounded-button">Tous les Élèves</button>
</div>
<div class="chart-container" id="levelChart"></div>
</div>
</div>
<div class="mt-6 bg-white rounded-lg shadow-sm">
<div class="p-6 border-b">
<div class="flex items-center justify-between">
<h3 class="font-semibold">Cours Récents</h3>
<button class="text-sm text-primary hover:text-primary/80 !rounded-button">Voir Tout</button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full">
<thead>
<tr class="text-left text-sm text-gray-500">
<th class="px-6 py-4 font-medium">Cours</th>
<th class="px-6 py-4 font-medium">Enseignant</th>
<th class="px-6 py-4 font-medium">Niveau</th>
<th class="px-6 py-4 font-medium">Élèves</th>
<th class="px-6 py-4 font-medium">Statut</th>
<th class="px-6 py-4 font-medium"></th>
</tr>
</thead>
<tbody>
<tr class="border-t">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 flex items-center justify-center bg-primary/10 text-primary rounded">
<i class="ri-book-open-line"></i>
</div>
<div>
<p class="font-medium">Allemand Débutant A1</p>
<p class="text-sm text-gray-500">Lundi, 09:00 - 10:30</p>
</div>
</div>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<img src="https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20middle%20aged%20german%20man%20with%20glasses%2C%20wearing%20business%20casual%20attire%2C%20natural%20lighting%2C%20neutral%20background&width=32&height=32&seq=2&orientation=squarish" class="w-8 h-8 rounded-full">
<span>Thomas Weber</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2 py-1 text-xs font-medium bg-blue-50 text-blue-700 rounded">A1</span>
</td>
<td class="px-6 py-4">18 / 20</td>
<td class="px-6 py-4">
<span class="px-2 py-1 text-xs font-medium bg-green-50 text-green-700 rounded">En cours</span>
</td>
<td class="px-6 py-4">
<button class="text-gray-400 hover:text-gray-600 !rounded-button">
<div class="w-8 h-8 flex items-center justify-center">
<i class="ri-more-2-line"></i>
</div>
</button>
</td>
</tr>
<tr class="border-t">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 flex items-center justify-center bg-primary/10 text-primary rounded">
<i class="ri-book-open-line"></i>
</div>
<div>
<p class="font-medium">Allemand Intermédiaire B1</p>
<p class="text-sm text-gray-500">Mardi, 14:00 - 15:30</p>
</div>
</div>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<img src="https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20young%20german%20woman%20with%20blonde%20hair%2C%20wearing%20business%20attire%2C%20natural%20lighting%2C%20neutral%20background&width=32&height=32&seq=3&orientation=squarish" class="w-8 h-8 rounded-full">
<span>Anna Schmidt</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2 py-1 text-xs font-medium bg-purple-50 text-purple-700 rounded">B1</span>
</td>
<td class="px-6 py-4">15 / 15</td>
<td class="px-6 py-4">
<span class="px-2 py-1 text-xs font-medium bg-green-50 text-green-700 rounded">En cours</span>
</td>
<td class="px-6 py-4">
<button class="text-gray-400 hover:text-gray-600 !rounded-button">
<div class="w-8 h-8 flex items-center justify-center">
<i class="ri-more-2-line"></i>
</div>
</button>
</td>
</tr>
<tr class="border-t">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 flex items-center justify-center bg-primary/10 text-primary rounded">
<i class="ri-book-open-line"></i>
</div>
<div>
<p class="font-medium">Allemand Avancé C1</p>
<p class="text-sm text-gray-500">Mercredi, 18:00 - 19:30</p>
</div>
</div>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<img src="https://readdy.ai/api/search-image?query=professional%20headshot%20of%20a%20middle%20aged%20german%20woman%20with%20red%20hair%2C%20wearing%20business%20casual%20attire%2C%20natural%20lighting%2C%20neutral%20background&width=32&height=32&seq=4&orientation=squarish" class="w-8 h-8 rounded-full">
<span>Lisa Müller</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2 py-1 text-xs font-medium bg-orange-50 text-orange-700 rounded">C1</span>
</td>
<td class="px-6 py-4">12 / 12</td>
<td class="px-6 py-4">
<span class="px-2 py-1 text-xs font-medium bg-green-50 text-green-700 rounded">En cours</span>
</td>
<td class="px-6 py-4">
<button class="text-gray-400 hover:text-gray-600 !rounded-button">
<div class="w-8 h-8 flex items-center justify-center">
<i class="ri-more-2-line"></i>
</div>
</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</main>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
const enrollmentChart = echarts.init(document.getElementById('enrollmentChart'));
enrollmentChart.setOption({
animation: false,
grid: { top: 0, right: 0, bottom: 0, left: 0 },
xAxis: {
type: 'category',
data: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
axisLine: { show: false },
axisTick: { show: false },
axisLabel: { color: '#6B7280' }
},
yAxis: {
type: 'value',
show: false
},
series: [{
data: [150, 180, 220, 240, 200, 250, 280, 260, 245, 248, 270, 285],
type: 'line',
smooth: true,
symbol: 'none',
lineStyle: { color: 'rgba(87, 181, 231, 1)' },
areaStyle: {
color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
offset: 0,
color: 'rgba(87, 181, 231, 0.2)'
}, {
offset: 1,
color: 'rgba(87, 181, 231, 0)'
}])
}
}]
});
const levelChart = echarts.init(document.getElementById('levelChart'));
levelChart.setOption({
animation: false,
tooltip: {
trigger: 'item',
backgroundColor: 'rgba(255, 255, 255, 0.9)',
borderColor: '#E5E7EB',
textStyle: { color: '#1F2937' }
},
series: [{
type: 'pie',
radius: ['60%', '80%'],
data: [
{ value: 35, name: 'A1' },
{ value: 30, name: 'A2' },
{ value: 20, name: 'B1' },
{ value: 15, name: 'B2' }
],
label: { show: false },
itemStyle: {
borderRadius: 4,
borderColor: '#fff',
borderWidth: 2,
color: function(params) {
const colors = [
'rgba(87, 181, 231, 1)',
'rgba(141, 211, 199, 1)',
'rgba(251, 191, 114, 1)',
'rgba(252, 141, 98, 1)'
];
return colors[params.dataIndex];
}
}
}]
});
window.addEventListener('resize', function() {
enrollmentChart.resize();
levelChart.resize();
});
});
</script>
</body>
</html>
