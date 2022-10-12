<?php

namespace JetBox\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

trait Translatable
{
    /**
     * @param Builder $query
     * @param $locales
     * @param bool $fallback
     * @return void
     */
    public function scopeWithTranslations(Builder $query, $locales = null, $fallback = true): void
    {
        list($locales, $fallback) = $this->getLocales($locales, $fallback);

        $query->with(['translations' => function (Relation $q) use ($locales, $fallback) {

            if (is_array($locales)) {
                $q->whereIn('locale', $locales);
            } else {
                $q->where('locale', $locales);
            }

            if ($fallback !== false) {
                $q->orWhere('locale', $fallback);
            }
        }]);
    }

    /**
     * @param $attribute
     * @param null $locale
     * @param bool $fallback
     * @return mixed|null
     */
    public function getTranslated($attribute, $locale = null, $fallback = true)
    {
        if (!in_array($attribute, $this->getTranslatableAttributes())) {
            return $this->getAttribute($attribute);
        }

        list($locale, $fallback) = $this->getLocales($locale, $fallback);

        if (!$this->relationLoaded('translations')) {
            $this->load('translations');
        }

        $translations = $this->getRelation('translations')
            ->where('column_name', $attribute);

        $localeTranslation = $translations->where('locale', $locale)->first();

        if ($localeTranslation) {
            return $localeTranslation->value;
        }

        $fallbackTranslation = $translations->where('locale', $fallback)->first();

        if ($fallbackTranslation && $fallback !== false) {
            return $fallbackTranslation->value;
        }

        return null;
    }

    /**
     * @param $locales
     * @param $fallback
     * @return array
     */
    public function getLocales($locales, $fallback): array
    {
        if (is_null($locales)) {
            $locales = app()->getLocale();
        }

        if ($fallback === true) {
            $fallback = config('app.fallback_locale', 'en');
        }

        return [$locales, $fallback];
    }

    /**
     * @return array
     */
    public function getTranslatableAttributes(): array
    {
        return property_exists($this, 'translatable') ? $this->translatable : [];
    }
}
