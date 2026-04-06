@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('header-content')
    <h1 class="text-xl font-semibold text-gray-800">Tableau de bord</h1>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <i class="ri-search-line text-gray-400"></i>
        </div>
        <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 w-96 rounded-lg border-none bg-gray-50 focus:ring-2 focus:ring-primary/20 text-sm">
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Élèves</p>
                    <p class="text-2xl font-semibold mt-1">{{ $totalStudents }}</p>
                </div>
                <div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
                    <i class="ri-user-line"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Enseignants</p>
                    <p class="text-2xl font-semibold mt-1">{{ $totalTeachers }}</p>
                </div>
                <div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
                    <i class="ri-team-line"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Cours Actifs</p>
                    <p class="text-2xl font-semibold mt-1">{{ $activeCoursesCount }}</p>
                </div>
                <div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
                    <i class="ri-book-open-line"></i>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    @if($isAdmin)
                        <p class="text-sm text-gray-500">Total Écoles Actives</p>
                        <p class="text-2xl font-semibold mt-1">{{ $totalSchools }}</p>
                    @else
                        <p class="text-sm text-gray-500">Taux de Réussite</p>
                        <p class="text-2xl font-semibold mt-1">98%</p>
                    @endif
                </div>
                <div class="w-10 h-10 flex items-center justify-center bg-primary/10 text-primary rounded-lg">
                    @if($isAdmin)
                        <i class="ri-building-line"></i>
                    @else
                        <i class="ri-line-chart-line"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="font-semibold mb-6">Progression des Inscriptions ({{ $currentSchoolName ?? 'École non définie' }})</h3>
            <div class="h-60" id="enrollmentChart"></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="font-semibold mb-6">Distribution des Niveaux ({{ $currentSchoolName ?? 'École non définie' }})</h3>
            <div class="h-60" id="levelChart"></div>
        </div>
    </div>

    @if($isAdmin)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold mb-6">Progression des Inscriptions (Global toutes écoles)</h3>
                <div class="h-60" id="enrollmentChartGlobal"></div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold mb-6">Distribution des Niveaux (Global toutes écoles)</h3>
                <div class="h-60" id="levelChartGlobal"></div>
            </div>
        </div>
    @endif

    @if($isAdmin)
        <div class="mt-6 bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 border-b">
                <h3 class="font-semibold">Statistiques par école</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-sm text-gray-500">
                            <th class="px-6 py-4 font-medium">École</th>
                            <th class="px-6 py-4 font-medium">Élèves</th>
                            <th class="px-6 py-4 font-medium">Enseignants</th>
                            <th class="px-6 py-4 font-medium">Cours actifs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schoolStats as $schoolStat)
                            <tr class="border-t">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $schoolStat['name'] }}</td>
                                <td class="px-6 py-4">{{ $schoolStat['students_count'] }}</td>
                                <td class="px-6 py-4">{{ $schoolStat['teachers_count'] }}</td>
                                <td class="px-6 py-4">{{ $schoolStat['active_courses_count'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Aucune école active trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-6 bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="font-semibold">Cours Récents</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500">
                        <th class="px-6 py-4 font-medium">Cours</th>
                        <th class="px-6 py-4 font-medium">Enseignant</th>
                        <th class="px-6 py-4 font-medium">Niveau</th>
                        <th class="px-6 py-4 font-medium">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentCourses as $course)
                        <tr class="border-t">
                            <td class="px-6 py-4">
                                <a href="{{ route('courses.show', $course) }}" class="font-medium hover:text-primary">{{ $course->title }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $course->teacher->first_name ?? '' }} {{ $course->teacher->last_name ?? '' }}</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium bg-blue-50 text-blue-700 rounded">{{ $course->level }}</span></td>
                            <td class="px-6 py-4">
                                @if(\Carbon\Carbon::parse($course->end_date)->isPast())
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded">Terminé</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded">En cours</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center px-6 py-4 text-gray-500">Aucun cours récent.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const enrollmentChart = echarts.init(document.getElementById('enrollmentChart'));
        enrollmentChart.setOption({
            tooltip: { trigger: 'axis' },
            xAxis: {
                type: 'category',
                data: @json($enrollmentLabels),
                axisLine: { show: false },
                axisTick: { show: false },
            },
            yAxis: { type: 'value', show: false },
            series: [{
                data: @json($enrollmentData),
                type: 'line',
                smooth: true,
                symbol: 'none',
                lineStyle: { color: '#4F46E5' },
                areaStyle: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(79, 70, 229, 0.2)'
                    }, {
                        offset: 1,
                        color: 'rgba(79, 70, 229, 0)'
                    }])
                }
            }]
        });

        const levelChart = echarts.init(document.getElementById('levelChart'));
        levelChart.setOption({
            tooltip: { trigger: 'item' },
            series: [{
                type: 'pie',
                radius: ['60%', '80%'],
                avoidLabelOverlap: false,
                data: @json($levelChartData),
                label: { show: false },
                itemStyle: {
                    borderRadius: 4,
                    borderColor: '#fff',
                    borderWidth: 2
                }
            }]
        });

        let enrollmentChartGlobal = null;
        let levelChartGlobal = null;

        @if($isAdmin)
            const enrollmentGlobalEl = document.getElementById('enrollmentChartGlobal');
            const levelGlobalEl = document.getElementById('levelChartGlobal');

            if (enrollmentGlobalEl) {
                enrollmentChartGlobal = echarts.init(enrollmentGlobalEl);
                enrollmentChartGlobal.setOption({
                    tooltip: { trigger: 'axis' },
                    legend: { type: 'scroll', top: 0 },
                    grid: { top: 40 },
                    xAxis: {
                        type: 'category',
                        data: @json($globalEnrollmentLabels),
                        axisLine: { show: false },
                        axisTick: { show: false },
                    },
                    yAxis: { type: 'value', show: false },
                    series: @json($globalEnrollmentSeries)
                });
            }

            if (levelGlobalEl) {
                levelChartGlobal = echarts.init(levelGlobalEl);
                levelChartGlobal.setOption({
                    tooltip: { trigger: 'item' },
                    series: [{
                        type: 'pie',
                        radius: ['60%', '80%'],
                        avoidLabelOverlap: false,
                        data: @json($globalLevelChartData),
                        label: { show: false },
                        itemStyle: {
                            borderRadius: 4,
                            borderColor: '#fff',
                            borderWidth: 2
                        }
                    }]
                });
            }
        @endif

        window.addEventListener('resize', function() {
            enrollmentChart.resize();
            levelChart.resize();
            if (enrollmentChartGlobal) {
                enrollmentChartGlobal.resize();
            }
            if (levelChartGlobal) {
                levelChartGlobal.resize();
            }
        });
    });
</script>
@endpush