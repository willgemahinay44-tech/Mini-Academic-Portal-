@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 style="margin: 0; font-size: 28px;">Courses</h1>
        <p style="margin: 6px 0 0 0; color: #718096; font-size: 14px;">Browse all available courses</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">+ Add Course</button>
</div>

<div class="row">
    @foreach($courses as $course)
    <div class="col-md-4 mb-4">
        <div class="card h-100" style="border-top: 3px solid #48bb78;">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                    <div>
                        <h5 style="margin: 0; font-size: 16px; line-height: 1.3;">{{ $course->course_name }}</h5>
                        <p style="margin: 4px 0 0 0; color: #718096; font-size: 13px;">{{ $course->course_code }}</p>
                    </div>
                    <span style="background-color: #f0fff4; color: #22543d; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Available</span>
                </div>
                <div style="border-top: 1px solid #f7fafc; padding-top: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="margin: 0; color: #718096; font-size: 13px;">Enrolled</p>
                            <p style="margin: 4px 0 0 0; font-size: 14px; font-weight: 500;">{{ $course->students->count() }}/{{ $course->capacity }}</p>
                        </div>
                        <div style="flex: 1; height: 4px; background-color: #f7fafc; border-radius: 2px; margin: 0 12px; overflow: hidden;">
                            <div style="height: 100%; background-color: #3182ce; width: {{ ($course->students->count() / $course->capacity) * 100 }}%;"></div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary btn-sm" style="margin-top: 12px; width: 100%;">View Details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border:1px solid #e2e8f0;">
            <div class="modal-header" style="border-bottom:1px solid #e2e8f0;">
                <h5 class="modal-title">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input id="course_code" name="course_code" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input id="course_name" name="course_name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input id="capacity" name="capacity" type="number" class="form-control" min="1" value="30" required>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#addCourseModal form');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (!res.ok) {
                const err = await res.json().catch(()=>({message:'Validation error'}));
                alert(err.message || 'Failed to create course');
                return;
            }

            const data = await res.json();
            const course = data.course;

            const container = document.querySelector('.row');
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-4';
            col.innerHTML = `
                <div class="card h-100" style="border-top: 3px solid #48bb78;">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <div>
                                <h5 style="margin: 0; font-size: 16px; line-height: 1.3;">${escapeHtml(course.course_name)}</h5>
                                <p style="margin: 4px 0 0 0; color: #718096; font-size: 13px;">${escapeHtml(course.course_code)}</p>
                            </div>
                            <span style="background-color: #f0fff4; color: #22543d; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">Available</span>
                        </div>
                        <div style="border-top: 1px solid #f7fafc; padding-top: 12px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <p style="margin: 0; color: #718096; font-size: 13px;">Enrolled</p>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; font-weight: 500;">0/${course.capacity}</p>
                                </div>
                                <div style="flex: 1; height: 4px; background-color: #f7fafc; border-radius: 2px; margin: 0 12px; overflow: hidden;">
                                    <div style="height: 100%; background-color: #3182ce; width: 0%;"></div>
                                </div>
                            </div>
                        </div>
                        <a href="/courses/${course.id}" class="btn btn-primary btn-sm" style="margin-top: 12px; width: 100%;">View Details</a>
                    </div>
                </div>
            `;
            container.prepend(col);

            
            const modalEl = document.getElementById('addCourseModal');
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.hide();

          
            form.reset();

            
            const containerDiv = document.querySelector('.container');
            const alert = document.createElement('div');
            alert.className = 'alert alert-success';
            alert.textContent = 'Course created successfully.';
            containerDiv.insertBefore(alert, containerDiv.firstChild);
            setTimeout(()=> alert.remove(), 3000);

        } catch (err) {
            console.error(err);
            alert('Unexpected error creating course');
        }
    });

    function escapeHtml(unsafe) {
        return String(unsafe).replace(/[&<>"]/g, function (s) {
            return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'})[s];
        });
    }
});
</script>
@endpush
@endsection