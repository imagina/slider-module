<div class="form-group">
    <label for="page">{{ trans('slider::slides.form.page') }}</label>
    <select class="form-control" name="page_id" id="page">
        <option value=""></option>
        <?php foreach ($pages as $page): ?>
            <option value="{{ $page->id }}" {{ $slide->page_id == $page->id ? 'selected' : '' }}>
                {{ $page->title }}
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="target">{{ trans('slider::slides.form.target') }}</label>
    <select class="form-control" name="target" id="target">
        <option value="_self" {{ $slide->target == '_self' ? 'selected' : '' }}>{{ trans('slider::slides.form.same tab') }}</option>
        <option value="_blank" {{ $slide->target == '_blank' ? 'selected' : '' }}>{{ trans('slider::slides.form.new tab') }}</option>
    </select>
</div>

<div class="form-group{{ $errors->has("external_image_url") ? ' has-error' : '' }}">
    {!! Form::label("external_image_url", trans('slider::slider.form.external image url')) !!}
    {!! Form::text("external_image_url", old("external_image_url", $slide->external_image_url), ['class' => 'form-control', 'placeholder' => trans('slider::slider.form.placeholder.external image url')]) !!}
    {!! $errors->first("external_image_url", '<span class="help-block">:message</span>') !!}
</div>

@include('media::admin.fields.file-link', [
    'entityClass' => 'Modules\\\\Slider\\\\Entities\\\\Slide',
    'entityId' => $slide->id,
    'zone' => 'slideimage'
])
