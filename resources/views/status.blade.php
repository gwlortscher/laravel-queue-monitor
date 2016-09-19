<table class="table">
    <thead>
        <th>
            Queue name
        </th>
        <th>
            Num Messages
        </th>
        <th>
            Status
        </th>
        <th>
            Details
        </th>
        <th>
            Check queued
        </th>
        <th>
            Queue job completed
        </th>
    </thead>
    <tbody>
        @foreach ($queues as $queue)
            <tr class="
                @if ($queue->status->isError())
                    danger
                @elseif ($queue->status->isOk())
                    success
                @elseif ($queue->status->isPending())
                    warning
                @endif
            ">
                <td>
                    <code>
                        {{ $queue->status->getQueueName() }}
                    </code>
                </td>
                <td>
                    {{ $queue->redis->getMessageCount() or 'N/A' }}
                </td>
                <td>
                    {{ $queue->status->getStatus() }}
                </td>
                <td>
                    {{ $queue->status->getMessage() }}
                </td>
                <td>
                    @include('queue-monitor::date', ['date' => $queue->status->getStartTime()])
                </td>
                <td>
                    @include('queue-monitor::date', ['date' => $queue->status->getEndTime()])
                    @if (($start = $queue->status->getStartTime()) && ($end = $queue->status->getEndTime()))
                        <span class="text-muted">
                            ({{ $end->diffForHumans($start) }})
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
