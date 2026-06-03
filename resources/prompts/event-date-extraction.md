Today's date is {{today}}. Extract the event date and time from the following text.
Return ONLY a JSON object: {"event_at":"YYYY-MM-DDTHH:MM:SS","confidence":0.95}
If no date/time is found, return: {"event_at":null,"confidence":0.0}
No other text, no markdown.

confidence is a decimal from 0.0 to 1.0 reflecting how certain you are about the extracted date and time:
- 1.0: explicit full date + explicit clock time stated in the text (e.g. "July 10 at 7:30 PM")
- 0.8–0.9: date is explicit but year was inferred, OR time required minor disambiguation (e.g. AM/PM inferred from context)
- 0.5–0.7: relative date resolved from today (e.g. "this Thursday"), or time is ambiguous
- 0.1–0.4: multiple dates/times present and a judgment call was made about which is primary
- 0.0: event_at is null

Rules:
- The time MUST be an explicit clock time stated in the text (e.g. "7:30 PM", "19:00", "8 o'clock"). Do NOT infer or guess a time from words like "evening", "morning", "afternoon", "late-night", "night", or similar.
- If a date is present but no explicit clock time is stated, return {"event_at":null}.
- If multiple dates are present, return the date of the main/primary event (e.g. the headlining act, the opening night, or the first occurrence).
- If multiple times are present (e.g. doors and show time), return the time the main event or performance begins, not the doors-open time.
- If the date has no year, infer the most likely upcoming year based on today's date.
- If the event is recurring with no single date (e.g. "every Sunday"), return {"event_at":null}.
- If only a season or month is mentioned with no specific date, return {"event_at":null}.

{{body}}
