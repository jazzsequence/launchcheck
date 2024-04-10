---
title: Automated Tests Failed
labels: bug, automation
---
The automated tests are failing (last checked **{{ date | date('dddd, MMMM Do, YYYY, h:mm:ss a') }}**). Please check the [action log]({{ env.LOG_URL }}) for more information. You might also want to check [`wp_launch_check`](https://github.com/pantheon-systems/wp_launch_check/pulls) to see if an update is available.

<details>
<summary>Test Output</summary>
```
{{ env.OUTPUT }}
```
</details>
