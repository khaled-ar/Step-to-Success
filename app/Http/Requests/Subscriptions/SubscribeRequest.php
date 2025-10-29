<?php

namespace App\Http\Requests\Subscriptions;

use App\Models\{
    Course,
    Subscription
};
use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subscribable' => ['required', 'string', 'in:single_course,all_courses'],
            'course_id' => ['required_if:subscribable,single_course', 'integer', 'exists:courses,id'],
            'type' => ['required_if:subscribable,all_courses', 'string', 'in:scientific,literary'],
        ];
    }

    public function store() {
        $user = $this->user();
        $data = $this->validated();

        $subscription = Subscription::whereUserId($user->id)
            ->whereIn('subscribable', ['all_courses', 'جميع المواد'])
            ->whereIn('status', ['active', 'pending'])
            ->first();
        if($subscription) {
            return $this->generalResponse(null, 'You already have a subscription', 400);
        }

        if($this->subscribable == 'single_course') {
            $subscription = Subscription::whereUserId($user->id)
                ->whereCourseId($this->course_id)
                ->whereIn('status', ['active', 'pending'])
                ->first();
            if($subscription) {
                return $this->generalResponse(null, 'You already have a subscription', 400);
            }

            $course = Course::whereId($this->course_id)->first();
            $data['total'] = $course->price;
            $data['type'] = $course->type;

        } else {
            $sum = Course::whereType($this->type)->sum('price');
            $data['total'] = round($sum - $sum * ($this->type == 'scientific' ? 0.12 : 0.0909));
            $data['type'] = $this->type == 'scientific' ? 'علمي' : 'ادبي';
        }

        $data['user_id'] = $user->id;
        $subscription = Subscription::create($data);
        return $this->generalResponse(['subscription_id' => $subscription->id, 'total' => $subscription->total], '201', 201);
    }
}
